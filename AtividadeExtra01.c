#include <stdio.h>

int main() {
	int dist, gas;
	float consumo;
/*Apuração de variáveis*/
printf("--Calculadora de consumo km/l--\nQue distância você percorreu? ");
    scanf("%d", &dist);
printf("\nQuantos litros de combustível você gastou? ");
    scanf("%d", &gas);

/*Cálculo e resposta*/
	consumo = dist/gas;
	printf("\n\nSeu veículo consumiu %.2fkm/l", consumo);

    return 0;
}