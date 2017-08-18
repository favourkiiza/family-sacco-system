/*
    CLIENT PROGRAM
*/
#include <stdio.h> 
#include <string.h>    
#include <sys/socket.h>    
#include <arpa/inet.h> 
#include <fcntl.h> 
#include <unistd.h> 
#include <termios.h>
#include <stdlib.h>
 
int main(int argc , char *argv[])
{
    int sock;
    struct sockaddr_in server;
    char message[1000] , server_reply[2000];
    char uname[100];
    char user_password[100];
    struct  termios term, term_orig;
        
    //Create socket
    sock = socket(AF_INET , SOCK_STREAM , 0);
    if (sock == -1)
    {
        printf("Could not create socket");
    }
     
    server.sin_addr.s_addr = inet_addr("127.0.0.1");
    server.sin_family = AF_INET;
    server.sin_port = htons( 1118 );
 
    //Connect to remote server
    if (connect(sock , (struct sockaddr *)&server , sizeof(server)) < 0)
    {
        perror("connection failed. Error");
        return 1;
    }
    
    
    //Keep communicating with server
    while(1)
    {
        memset(uname, 0, 255);
        memset(user_password, 0, 255);
        printf("\n_____________________________\033[01;34mFAMILY SACCO SYSTEM\033[0m_____________________________\n\n");
        puts("\033[22;33m\t\t\t    LOGIN\033[0m");
        printf("\033[22;31m\t\t\t*\033[0m\033[22;32mUsername : \033[0m");
        fgets(uname,100,stdin);
        /// Remove trailing newline, if they exist. 
            if ((strlen(uname)>0) && (uname[strlen (uname) - 1] == '\n')){
                uname[strlen (uname) - 1] = '\0';   
            }
        send(sock , uname , strlen(uname) , 0);

        //Disable password being shown
        tcgetattr(STDIN_FILENO, &term);
        term_orig = term;
        term.c_lflag &= ~ECHO;
        tcsetattr(STDIN_FILENO, TCSANOW, &term);

        printf("\033[22;31m\t\t\t*\033[0m\033[22;32mPassword : \033[0m");
        fgets(user_password,100,stdin);
        // Remove trailing newline, if they exist. 
            if ((strlen(user_password)>0) && (user_password[strlen (user_password) - 1] == '\n')){
                user_password[strlen (user_password) - 1] = '\0';   
            }
        send(sock , user_password , strlen(user_password) , 0);
        
        tcsetattr(STDIN_FILENO, TCSANOW, &term_orig); //enable echo back
        printf("\n");
        //receive confirmation from server
        recv(sock , server_reply , 5000 , 0);
        
        if(strcmp(server_reply,"Yes") == 0)
        {
            printf("\033[01;33mWelcome\033[0m \033[22;36m%s\033[0m\n", uname);

            while(1)
            {   printf("\033[01;32m");
                fgets(message,1000,stdin);
                printf("\033[0m");
                /* Remove trailing newline, if they exist. */
                if ((strlen(message)>0) && (message[strlen (message) - 1] == '\n'))
                {
                    message[strlen (message) - 1] = '\0';   
                }

                //Send Command to the Server
                if( send(sock , message , strlen(message) , 0) < 0)
                {
                    puts("Send failed");
                    return 1;
                }
                memset(message, 0, 255);
                memset(server_reply, 0, 255);

         
                /*Receive a response from the server if any is available*/
                if( recv(sock , server_reply , 5000 , 0) > 0)
                {                   
                   if (strcmp(server_reply , "Loged out successfully, \nBye") == 0)
                   {
                        printf("\033[01;35m%s\033[0m\n", server_reply);
                        memset(server_reply, 0, 255);
                        break;
                   }else{
                        printf("\033[22;34m%s\033[0m\n", server_reply);
                   }
                }
                memset(server_reply, 0, 255);
            }
        }
        else
        {
            puts("\033[01;31m\t\tWrong Username or Password!, Try Again\033[0m");
        }         
    }
    close(sock);
    return 0;
}