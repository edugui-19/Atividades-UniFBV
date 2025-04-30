#include <stdio.h>

int main() {
    int dist, tempo, velocidade;
	char partida[30], chegada[30];
	
/*Apuração de informações*/
printf("Em que cidade você começou sua viagem?\n");
    scanf("%s", &partida);
printf("Qual foi o seu destino?\n");
    scanf("%s", &chegada);
printf("Qual a distância entre essas cidades?\n");
    scanf("%i", &dist);
printf("Por último, quanto tempo durou sua viagem?\n");
    scanf("%i", &tempo);
    
/*Cálculo e resposta*/
velocidade = dist/tempo;
printf("\n\nSua viagem de %s para %s durou %i horas, e você percorreu %i quilômetros a %ikm/h.", partida, chegada, tempo, dist, velocidade);
    
return 0;
}
