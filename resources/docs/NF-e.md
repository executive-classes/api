# NF-e

**Documentação da ferramenta criada e bibliotecas usadas para a geração de notas fiscais.**

Guias:
- *Biblioteca usada*: [nfephp-org/sped-nfe](https://github.com/nfephp-org/sped-nfe)
- *Guia para uso da biblioteca*: 
  - [iMasters](https://imasters.com.br/back-end/emitindo-nfe-com-php)
  - [Google Groups](https://groups.google.com/g/nfephp/c/GGrSVS3T2uk)
- *Documentação completa de todas as tags das notas fiscais*: [PDF](http://www.nfe.fazenda.gov.br/portal/exibirArquivo.aspx?conteudo=URCYvjVMIzI=)

## Tags

**tagide** (Informações):

- **cUF** (Código da UF do emitente do Documento Fiscal):
    - [*Códigos*](https://www.oobj.com.br/bc/article/quais-os-códigos-de-cada-uf-no-brasil-465.html)
- **natOp** (Tipo de operação):
    - [*Tipos*](https://blog.softensistemas.com.br/natureza-da-operacao-na-nfe/)
- **mod** (Código do Modelo do Documento Fiscal):
    - *55*: NF-e emitida em substituição ao modelo 1 ou 1A;
    - *65*: NFC-e, utilizada nas operações de venda no varejo (a critério da UF aceitar este modelo de documento).
- **serie** (Série do Documento Fiscal)
    - *1* a *999*
- **dhEmi** (Data e hora de emissão do Documento Fiscal):
    - Formato: *AAAA-MM-DDThh:mm:ssTZD*
      - Ex: 2018-02-06T20:48:00-02:00
- **tpNF** (Tipo de Operação):
    - *1*: Entrada
    - *2*: Saída
- **idDest** (Identificador de local de destino da operação):
    - *1*: Operação interna
    - *2*: Operação interestadual
    - *3*: Operação com exterior
- **cMunFG** (Código do Município de Ocorrência do Fato Gerador):
    - [*Códigos*](http://www.sped.fazenda.gov.br/spedtabelas/AppConsulta/publico/aspx/ConsultaTabelasExternas.aspx?CodSistema=SpedFiscal)
- **tpImp** (Formato de Impressão do DANFE):
    - *0*: Sem geração de DANFE;
    - *1*: DANFE normal, Retrato
    - *2*: DANFE normal, Paisagem
    - *3*: DANFE Simplificado
    - *4*: DANFE NFC-e
    - *5*: DANFE NFC-e em mensagem eletrônica (o envio de mensagem eletrônica pode ser feita de forma simultânea com a impressão do DANFE; usar o =5 quando esta for a única forma de disponibilização do DANFE)
- **tpEmis** (Tipo de Emissão da NF-e):
    - *1*: Emissão normal (não em contingência);
    - *2*: Contingência FS-IA, com impressão do DANFE em formulário de segurança;
    - *3*: Contingência SCAN (Sistema de Contingência do Ambiente Nacional);
    - *4*: Contingência DPEC (Declaração Prévia da Emissão em Contingência);
    - *5*: Contingência FS-DA, com impressão do DANFE em formulário de segurança;
    - *6*: Contingência SVC-AN (SEFAZ Virtual de Contingência do AN);
    - *7*: Contingência SVC-RS (SEFAZ Virtual de Contingência do RS);
    - *9*: Contingência off-line da NFC-e (as demais opções decontingência são válidas também para a NFC-e).
      - Para a NFC-e somente estão disponíveis e são válidas as opções de contingência 5 e 9.
- **tpAmb** (Environment Identification):
    - *1*: Produção
    - *2*: Homologação
- **finNFe** (Finalidade de emissão da NF-e):
    - *1*: NF-e normal
    - *2*: NF-e complementar
    - *3*: NF-e de ajuste
    - *4*: Devolução de mercadoria
- **indFinal** (Indica operação com Consumidor final):
    - *0*: Normal
    - *1*: Consumidor final
- **indIntermed** (Indicador de intermediador/marketplace):
    - *0*: Operação sem intermediador (em site ou plataforma própria)
    - *1*: Operação em site ou plataforma de terceiros (intermediadores/marketplace)
- **indPres** (Indicador de presença do comprador no estabelecimento comercial no momento da operação):
    - *0*: Não se aplica
    - *1*: Operação presencial
    - *2*: Operação não presencial, pela Internet
    - *3*: Operação não presencial, Teleatendimento
    - *4*: NFC-e em operação com entrega a domicílio
    - *9*: Operação não [*O que é]
[*O que é]
[*O que é]presencial, outros.
- **procEmi** (Processo de emissão da NF-e):
    - *0*: Emissão de NF-e com aplicativo do contribuinte
    - *1*: Emissão de NF-e avulsa pelo Fisco
    - *2*: Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco
    - *3*: Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco

**tagide** (Emissor):

- **CRT** (Código de Regime Tributário)
    - *1*: Simples Nacional
    - *2*: Simples Nacional, excesso sublimite de receita bruta
    - *3*: Regime Normal

**tagenderEmit** (Endereço do Emissor)

- **cMun** (Código do município do Endereço do emitente)
    - [*Códigos*](http://www.sped.fazenda.gov.br/spedtabelas/AppConsulta/publico/aspx/ConsultaTabelasExternas.aspx?CodSistema=SpedFiscal)
- **cPais** (Código do País do Endereço do emitente)
    - [*Códigos*](https://www.fazcomex.com.br/blog/codigo-de-pais-para-siscomex-e-nfe/)

**tagdest** (Destinatário)

- **indIEDest** (Indicador da IE do Destinatário)
    - *1*: Contribuinte ICMS (informar a IE do destinatário)
    - *2*: Contribuinte isento de Inscrição no cadastro de Contribuintes

**tagprod** (Produto)

- **NCM** (Código NCM com 8 dígitos ou 2 dígitos (gênero)): 
    - [*O que é*](https://blog.tecnospeed.com.br/o-que-e-ncm/)
    - [*Lista*](https://investexportbrasil.dpr.gov.br/ProdutosServicos/frmPesquisaProdutosServicosFull.aspx)
- **CFOP** (Código Fiscal de Operações e Prestações):
    - [*O que é*](https://enotas.com.br/blog/cfop/)
    - [*Lista*](https://www.sefaz.pe.gov.br/Legislacao/Tributaria/Documents/Legislacao/Tabelas/CFOP.htm#Saídas_Outros_Estados_5000)
- **uCom** (Unidade Comercial do produto):
    - [*O que é*](https://webmaniabr.com/blog/voce-sabe-a-diferenca-entre-a-unidade-comercial-e-tributavel/)
    - [*Lista*](https://docs.google.com/spreadsheets/d/1dMAc1m3Bd3Yp7FxcSdwzYwENXbaF-NBIFHWTso2c5ag/edit#gid=145106505)
- **indTot** (Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)):
    - *0*: Valor do item (vProd) não compõe o valor total da NF-e
    - *1*: Valor do item (vProd) compõe o valor total da NF-e (vProd)

**tagdetPag** (Forma de pagamento)

- **indPag** (Indicador da Forma de Pagamento):
    - *0*: Pagamento à Vista
    - *1*: Pagamento à Prazo
    - *2*: Outros
- **tPag** (Forma de pagamento):
    - [*Lista*](https://atendimento.enotas.com.br/support/solutions/articles/43000516136-campos-do-tipo-de-pagamento-na-nfe-indpag-tpag-e-vpag-)
    - *01*: Dinheiro
    - *02*: Cheque
    - *03*: Cartão de Crédito
    - *04*: Cartão de Débito
    - *05*: Crédito Loja
    - *10*: Vale Alimentação
    - *11*: Vale Refeição
    - *12*: Vale Presente
    - *13*: Vale Combustível
    - *15*: Boleto Bancário
    - *16*: Depósito Bancário
    - *17*: Pagamento Instantâneo (PIX)
    - *18*: Transferência bancária, Carteira Digital
    - *19*: Programa de fidelidade, Cashback, Crédito Virtual.
    - *90*: Sem pagamento (apenas para NFe)
    - *99*: Outros
- **tBand** (Bandeira da operadora de cartão de crédito e/ou débito):
    - *01*: Visa
    - *02*: Mastercard
    - *03*: American Express
    - *04*: Sorocred
    - *99*: Outros