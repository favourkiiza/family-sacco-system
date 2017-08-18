/*
    SERVER SOCKET PROGRAM
*/
#include <stdio.h>
#include <string.h>   
#include <stdlib.h>    
#include <sys/socket.h>
#include <arpa/inet.h> 
#include <unistd.h>   
#include <pthread.h> 
#include <assert.h>
#include <mysql/mysql.h>
#include <math.h>
 
int total_contributions = 0;
MYSQL *connection;
MYSQL_RES *result;
MYSQL_ROW row;
char help[]=">contribution person_name amount date receipt_number- To submit a contribution\n>contribution check - See how much has been contributed\n>benefits check - Know how much has been received in benefits only\n>loan_request person_name amount date - Request a loan\n>loan status - check loan status\n>loan repayment_details - Check the loan repayment details\n>repay loan amount\n>idea  person_name   idea_name capital \"simpledescription\" - Submit a business idea\n>logout - Logout of the system";

//FUNCTION TO SPLIT A STRING OF CHARACTERS USING A SPECIFIED DELIMITER     
char** stringSplit(char* command_to_split, const char delimeter)
{
    char** finalresult    = 0;
    size_t count     = 0;
    char* temp        = command_to_split;
    char* last_comma = 0;
    char delim[2];
    delim[0] = delimeter;
    delim[1] = 0;

    /*Loop through to Count how many tokens will be extracted from the statement provided*/
    while (*temp)
    {
        if (delimeter == *temp)
        {
            count++;
            last_comma = temp;
        }
        temp++;
    }

    /*Add space for trailing token.*/
    count += last_comma < (command_to_split + strlen(command_to_split) - 1);

    /*Add space for terminating null string so caller knows where the list of returned strings ends. */
    count++;

    finalresult = malloc(sizeof(char*) * count);

    if (finalresult)
    {
        size_t id  = 0;
        char* token = strtok(command_to_split, delim);

        while (token)
        {
            assert(id < count);
            *(finalresult + id++) = strdup(token);
            token = strtok(0, delim);
        }
        assert(id == count - 1);
        *(finalresult + id) = 0;
    }
       return finalresult;
}

//FUNCTION TO CONNECT TO MYSQL
void connectToMysql()
{
    char *server = "localhost";
    char *user = "root";
    char *password = "123456";
    char *database = "familysacco";

    connection = mysql_init(NULL);

   /* Connect to database */
   if (!mysql_real_connect(connection, server,user, password, database, 0, NULL, 0)) 
   {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }
   
}


/* THIS FUNCTION WRITES THE DATA TO FILE */
void writeToFile(char command_to_save[100], int memberID1)
{
    FILE *pt;

    pt = fopen("SACCODATA.txt","a");//a, w, r

    if (pt == NULL)
    {
        puts("File not found");
    }

    fprintf(pt, "%s %d\n", command_to_save,memberID1);
    
    fclose(pt);
}

void closeMysqlConn(){
    /* close connection */
   mysql_free_result(result);
   mysql_close(connection);
}
/* THIS IS THE LOGIN FUNCTION*/
int login(char uname1[50], char user_password1[50])
{
    int value = 0;
    char sqlquery[1024];
    connectToMysql();
    sprintf(sqlquery, "select * from members where username = '%s' and password = '%s'",uname1,user_password1);
   /* send SQL query */
   if (mysql_query(connection, sqlquery)) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }

   result = mysql_use_result(connection);

   if ((row = mysql_fetch_row(result)) != NULL){
      value = 1; 
   }else{
      value = 0;
   }
   closeMysqlConn();
   return value;
}

int getMemberID(char uname1[50], char user_password1[50])
{
    int memberID;
    char sqlquery[1024];
    connectToMysql();
    sprintf(sqlquery, "select * from members where username = '%s' and password = '%s'",uname1,user_password1);
   /* send SQL query */
   if (mysql_query(connection, sqlquery)) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }

   result = mysql_use_result(connection);

   if ((row = mysql_fetch_row(result)) != NULL){
      memberID = atoi(row[0]); 
   }
   closeMysqlConn();
   return memberID;
}

void loanRequest(int id, int amount)
{
    char sqlquery1[1000];
    connectToMysql();
    sprintf(sqlquery1, "insert into loan (memberID,amount,action) values (%d,%d, 'Pending')",id,amount);
   /* send SQL query */
   if (mysql_query(connection, sqlquery1)) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }
   connectToMysql();
}

int findTotalContribution()
{
    int total = 0;
    connectToMysql();
   /* send SQL query */
   if (mysql_query(connection, "select * from contributions")) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }

   result = mysql_use_result(connection);

    while ((row = mysql_fetch_row(result)) != NULL){
      total = total + atoi(row[1]);
    }
    closeMysqlConn();
    return total;
}

int getBenefitID(){
    int benefitID;
    connectToMysql();
    /* send SQL query */
   if (mysql_query(connection, "select * from benefit")) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }

   result = mysql_use_result(connection);

   if ((row = mysql_fetch_row(result)) != NULL){
      benefitID = atoi(row[0]); 
   }else{
        benefitID = 0;
   }
   closeMysqlConn();
   return benefitID;

}

int indContribution(int id)
{
    int contribution1 = 0;
    char sqlquery2[100];
    sprintf(sqlquery2, "select * from contributions where id = %d",id);
    connectToMysql();
   /* send SQL query */
   if (mysql_query(connection, sqlquery2)) {
      fprintf(stderr, "%s\n", mysql_error(connection));
      exit(1);
   }

   result = mysql_use_result(connection);

    while ((row = mysql_fetch_row(result)) != NULL){
      contribution1 = contribution1 + atoi(row[1]);
    }
    closeMysqlConn();
    return contribution1;
}

double calculateBenefits(int id, int benefitid){
    int totalOutcome = 0, initialInvestment = 0;
    int amountContributed;
    int overallTotal;
    float share, benefit;
    int profit;
    char sqlquery3[50];

    connectToMysql();
    
    sprintf(sqlquery3, "select * from benefit where benefitID = %d",benefitid);
    puts(sqlquery3);
    if (mysql_query(connection, sqlquery3))
    {
        fprintf(stderr, "%s\n", mysql_error(connection));
        exit(1);
    }

    result = mysql_use_result(connection);

    while ((row = mysql_fetch_row(result)) != NULL){
      initialInvestment = atoi(row[2]);
      totalOutcome = atoi(row[1]);
    }

    overallTotal = findTotalContribution();
    amountContributed = indContribution(id);

    share = ((float)amountContributed/overallTotal) * 100;
    profit = totalOutcome - initialInvestment;
    benefit = (share/100)*(0.65)*profit;
    if (share > 50)
    {
        benefit += 0.05*profit;
    }

    return benefit;
}

int loanRepayment(int amount, int id){
    int balance;
    char sqlquery3[50], sqlquery4[50];

    connectToMysql();
    
    sprintf(sqlquery3, "select * from members where loan_ = %d",id);
    
    if (mysql_query(connection, sqlquery3))
    {
        fprintf(stderr, "%s\n", mysql_error(connection));
        exit(1);
    }

    result = mysql_use_result(connection);

    while ((row = mysql_fetch_row(result)) != NULL){
      balance = atoi(row[1]) - amount;
      printf("Your balance is now : %d\n", balance);
      sprintf(sqlquery4, "insert into loanrepayment (loanRepaymenId, amount, loan_no, balance) values (%d,%d,%d)",amount,id,balance);
      mysql_query(connection, sqlquery4);
    }

return balance;
}

/* FUNCTION TO HANDLE EACH CLIENT */
void *connection_handler(void *socket_desc)
{
    int sock = *(int*)socket_desc; //Get the socket descriptor
    char *message;
    char client_command[1000];
    int counter = 0;    
    char** client_command_tokens;
    int login_value;
    char pass[] = "Yes";
    char passno[] = "No";
    char uname[100];
    char user_password[100];
    char msg11[50] = "Wrong input, Try again";
    int memberID;
    int memberContribution = 0;
        
    while(1){
        
        recv(sock , uname , 100 , 0);

        recv(sock , user_password , 100 , 0);

        login_value = login(uname, user_password);
        
        if (login_value == 1)
        {
            send(sock , pass , strlen(pass) , 0);
            memberID = getMemberID(uname,user_password);//get the member id who has loged in
           
            do{
                memset(client_command,0,255);
                recv(sock , client_command , 1000 , 0);//Receive a message from client
                char client_command_temp[100];//to temporarily store client command
                
                for (int i = 0; i < strlen(client_command); ++i)
                {
                    client_command_temp[i] = client_command[i];//copy values of client_command and store them in client_command_temp
                }
                
                client_command_tokens = stringSplit(client_command, ' ');//split the commands using space
                
                if (client_command_tokens)
                {
                    for (int i = 0; *(client_command_tokens + i); i++)
                    {
                        counter++;
                    }

                    switch(counter)
                    {
                        case 1:
                            if (strcmp(*client_command_tokens,"logout") == 0)
                            {
                                login_value = 0;
                                char msg1[50] = "Loged out successfully, \nBye";
                                send(sock , msg1 , strlen(msg1) , 0);
                                //return 1;
                            }
                            else if (strcmp(*client_command_tokens,"help") == 0)
                            {
                                send(sock, help, strlen(help), 0);
                            }
                            else{
                                send(sock, msg11, strlen(msg11), 0);
                            }
                        break;
                        
                        case 2:
                            if (strcmp(*client_command_tokens,"benefits") == 0 && strcmp(*(client_command_tokens+1),"check") == 0)
                            {   
                                int benefitID;
                                benefitID = getBenefitID();
                                char msg2[50];
                                int bene;

                                if (benefitID == 1)
                                {
                                    bene = (int)calculateBenefits(memberID,benefitID);                                   
                                    sprintf(msg2,"Your benefits are : %d",bene);
                                    send(sock , msg2 , strlen(msg2) , 0);
                                }
                                
                            }else if (strcmp(*client_command_tokens,"contribution") == 0 && strcmp(*(client_command_tokens+1),"check") == 0)
                            {   
                                total_contributions = findTotalContribution();
                                memberContribution = indContribution(memberID);
                                char msg3[50];
                                sprintf(msg3, "Your total Contribution is : %d\nOverall Contributions : %d", memberContribution, total_contributions);
                                send(sock , msg3 , strlen(msg3) , 0);
                            }
                            else if (strcmp(*client_command_tokens , "loan") == 0 && strcmp(*(client_command_tokens+1) , "status") == 0)
                            {
                                char msg4[50] = "Rejected";
                                send(sock , msg4 , strlen(msg4) , 0);
                            }
                            else if (strcmp(*client_command_tokens , "loan") == 0 && strcmp(*(client_command_tokens+1) , "repayment_details") == 0)
                            {
                                char msg5[50] = "Loan Repayment Details Loading....";
                                send(sock , msg5 , strlen(msg5) , 0);    
                            }else{
                                send(sock, msg11, strlen(msg11), 0);
                            }                
                        break;
                
                        case 3:                   
                             if (strcmp(*client_command_tokens , "repay") == 0 && strcmp(*(client_command_tokens+1) , "loan") == 0)
                            {
                            	writeToFile(client_command_temp, memberID);
                            	loanRepayment(memberID,atoi(*client_command_tokens+2));
                            }
                            else{
                                send(sock, msg11, strlen(msg11), 0);
                            } 
                        break;

                        case 4:

                            if (strcmp(*client_command_tokens , "loan_request") == 0 )
                            {
                                writeToFile(client_command_temp,memberID); 
                                //writeToFileLoan(client_command_temp,uname,memberID);
                                total_contributions = findTotalContribution();  

                                if (atoi(*(client_command_tokens+2)) <= total_contributions/2)
                                {
                                    loanRequest(memberID,atoi(*(client_command_tokens+2)));
                                    char msg6[50] = "Loan request Submited";
                                    send(sock , msg6 , strlen(msg6) , 0);
                                }
                                else{
                                    char msg7[50] = "Loan request Submited";
                                    send(sock , msg7 , strlen(msg7) , 0);
                                } 
                            }
                        break;

                        case 5:
                            if (strcmp(*client_command_tokens , "contribution") == 0)
                            {
                                writeToFile(client_command_temp,memberID);
                                char msg9[500] = "Contribution received, please take the hard copy of the receipt to the admin for approval";
                                send(sock , msg9 , strlen(msg9) , 0);

                                //send(sock, msg11, strlen(msg11), 0);
                            }
                            else if (strcmp(*client_command_tokens , "idea") == 0)
                            {
                                total_contributions = findTotalContribution();
                                
                                if (atoi(*(client_command_tokens+2)) > (total_contributions/2))
                                {
                                    char msg8[100] = "Idea rejected, because it requires initial investment morethan 1/2 of available money";
                                    send(sock, msg8, strlen(msg8), 0);
                                }else{
                                    char msg13[50] = "Idea received, Pending for approval";
                                    send(sock, msg13, strlen(msg13), 0);
                                }
                                writeToFile(client_command_temp,memberID);
                                
                            }else{
                                send(sock, msg11, strlen(msg11), 0);
                            }                       
                        break;

                        default:
                            send(sock , msg11 , strlen(msg11) , 0);
                        break;          
                    }
                }
                memset(client_command, 0, 255);
                memset(client_command_temp, 0, 255);
                counter = 0;
            }while(login_value != 0);
        }
        else
        {
            send(sock , passno , strlen(passno) , 0);
            memset(uname, 0, 255);
            memset(user_password, 0, 255);
        }
    }    
        //Free the socket pointer
        free(socket_desc);
    return 0;
}


int main(int argc , char *argv[])
{  
	int bind1;
    int socket_desc = socket(AF_INET , SOCK_STREAM , 0);//create the socket.
    struct sockaddr_in server , client;
    int client_sock , c , *new_sock;
    

    if (socket_desc == -1)
    {
        printf("Could not create socket");
    }
     
    //Prepare the sockaddr_in structure
    server.sin_family = AF_INET;
    server.sin_addr.s_addr = INADDR_ANY;
    server.sin_port = htons( 1118);
     
    //Bind
    bind1 = bind(socket_desc,(struct sockaddr *)&server , sizeof(server));
    if(bind1 < 0)
    {
        perror("Bind Failed. Error");
        return 1;
    }
     
    listen(socket_desc , 20);//Listen for connection requests
              
    //Accept incoming connections
    puts("Listening for clients...");
    c = sizeof(struct sockaddr_in);
    
    while( (client_sock = accept(socket_desc, (struct sockaddr *)&client, (socklen_t*)&c)) )
    {       
        pthread_t sniffer_thread;
        new_sock = malloc(1);
        *new_sock = client_sock;
         
        if( pthread_create( &sniffer_thread , NULL ,  connection_handler , (void*) new_sock) < 0)
        {
            perror("could not create thread");
            return 1;
        }         
    }
     
    if (client_sock < 0)
    {
        perror("accept failed");
        return 1;
    }     
    return 0;
}