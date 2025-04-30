#include <stdio.h>

int main(){
    int num1, num2, resultado;

    printf("Insira o primeiro número da soma: ");
    scanf("%d", &num1);
    printf("Insira o segundo número da soma: ");
    scanf("%d", &num2);

    resultado = num1 + num2;
    if(resultado > 100){
        resultado -= 10;
        printf("O resultado da soma, subtraído por 10, é %d.", resultado);
    }
    else{
        printf("O resultado da soma é %d.", resultado);
    }

    return 0;
}