smtp_locaweb_ex.php
===================

Formulário simples de contato, escrito em PHP e utilizando o [Locaweb Style](http://locaweb.github.io/locawebstyle/) e utilizado como exemplo de implementação do [SMTP Locaweb](http://www.locaweb.com.br/produtos/smtp-locaweb.html) para envio de emails transacionais.

Você pode facilmente executar o exemplo tanto no trial [Jelastic](http://www.locaweb.com.br/produtos/jelastic-cloud.html) quanto localmente.

## Configurando os dados do SMTP

A primeira coisa a fazer é configurar os dados de USUÁRIO, SENHA e REMETENTE no painel do SMTP Locaweb e inserí-los nas 20-22 do arquivo `send.php`.

### Executando um servidor local

Uma vez feita  edição dos dados, podemos rodar o programa localmente. Uma maneira rápida de atingirmos esse objetivo e através do Vagrant. Primeiro, instale o [Vagrant](http://vagrantup.com/) no site do projeto.

Em seguida execute `vagrant up` para baixar e subir a máquina virtual e, em seguida, `vagrant reload --provision` para instalar o PHP5. Na sequência, acesse a máquina virtual com `vagrant ssh`.

Uma vez na máquina virtual, vá até o diretório `/vagrant` com um `cd /vagrant` e suba o servidor de desenvolvimento embutido no PHP através do comando:

```bash
php -S 0.0.0.0:8000
````

Agora é só abrir o navegador e acessar o formulário digitando: `localhost:8000/form.html`:

![Imagem da aplicação de exemplo](https://raw.githubusercontent.com/kemelzaidan/smtp_locaweb_ex.php/master/assets/images/form_smtp.jpg)

VOILÁ e divirta-se! :-)

