# Register-Php
Sistema de cadastro, login, ligação de banco de dados, validação e criptografia em PHP.

<h2>Index(Página de cadastro)</h2>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/0a873290-0374-4d79-b4cb-7d1a6649606a"> 
<br>
<p>A página principal ou página de cadastro, consiste em um formulário que requere informações básicas do usuário para que o registro seja feito no banco de dados após a validação.</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/585ed307-494c-470e-a80a-bf0dd7afffc1">
<p>Impondo dados como exemplo, digitei as informações necessárias para que seja feito um cadastro. Após os dados serem enviados, verificados e a senha for encriptografada pela validação com php, os dados são enviados e registrados no banco:</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/ca1aa7d4-0b8a-4491-a0e0-0cb707bd88d1">
<br>
<br>
<h2>Login</h2>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/2dc5d45e-7798-4de9-af82-6504df795b79">
<p>De forma simples e sucinta, a página de login requere apenas duas informações, sendo elas email e senha, para que o usuário possa iniciar uma sessão em sua conta e ter acesso ao seus dados através da página reestrita home.</p>
<br>
<br>
<h2>Home</h2>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/26f98aeb-bdec-454f-ae60-d6d413c1ee21">
<p>Assim, o usuário terá acesso à sua página restrita, em que pode livremente visualizar, modificar, apagar e atualizar seus dados. Além disso, também há outros campos a serem preenchidos com mais informações sobre o determinado usuário.</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/e60ca975-a138-418f-a72c-c150d0895860">
<p>A princípio, os campos estão desabilitados, porém, não há segredo para manipulá-los: basta deslizar um pouco mais a página e clicar no botão "alterar dados".</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/b409604b-0d9c-467f-a9b3-92fbd3268d0f">
<p>Com isso, os inputs serão liberados ao usuário e haverão dois botões, cujos quais enviam ou descartam as alterações ao serem clicados.</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/c93c4117-efed-498c-82f1-e22a28e2c968">
<p>Preenchendo alguns campos como exemplo, impus dados fictícios a serem cadastrados e modificados. Com isso, o banco de dados atualizado terá os seguintes registros em minha sessão: </p>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/083bbeb3-aa39-4ef0-b53d-f4256c762856">
<p>Note que há campos que estão vazios e nulos, pois apenas os dados de cadastro principais são obrigatórios a serem mantidos.</p>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/d877f5b6-7ada-4731-9838-8c603eae52a1">
<p>Ao deslizar um pouco mais a página, o usuário terá acesso ao botão "sair", em que ao clicar irá sair de sua sessão PHP, tornando-a reestrita novamente e o redirecionando para a página de login.</p>
<br>
<br>
<h2>Validações e mensagens de erro</h2>
<p>Obviamente, todo esse fluxo de informações e atualizações de registros não pode ocorrer sem nenhuma verificação ou validação. Por isso, o sistema possui diversas validações em todas as três páginas, moderando o fluxo de dados e envio de registros maliciosos ao banco de dados. Algumas das validações presentes nas páginas, são: </p>
<br>
<li>Validações da página principal</li>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/d5d398bc-53b8-4bd9-9b4f-4b87cda1e6e7">
<img src="https://github.com/MrSampaio/register-php/assets/118141328/ed699e1a-8c9c-4cd1-8161-1f123bcdeafb">
<br>
<br>
<li>Validações da página de login</li>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/0d0ebedc-0082-4f5c-9b89-d69660c117e8">
<img src="https://github.com/MrSampaio/register-php/assets/118141328/0f4ced38-d022-4768-b25d-ee98e8f7db61">
<br>
<br>
<li>Validações da página home</li>
<br>
<img src="https://github.com/MrSampaio/register-php/assets/118141328/90457ac2-80a7-4130-a94a-b9c3e04d9b69">
<img src="https://github.com/MrSampaio/register-php/assets/118141328/0452ebe7-43a1-46ff-bf8b-4a37af037575">
<br>
<br>

<p>O sistema foi feito utilizando HTML, CSS e JavaScript para o Front-end, enquanto o Back-end foi totalmente aplicado com PHP, desde a validação dos formulários até o gerenciamento de sessões e conexão com o banco de dados.</p>
<br>
<p>Projeto Full-Stack feito por mim, tendo em mente o aprendizado de ligação de databases com PHP e implementação de outras linguagens em um mesmo projeto</p>
<br>
<p>Obrigado por ter lido até aqui! :)</p>

