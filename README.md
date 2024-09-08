
# Pronto Psi

**Pronto Psi** é um plugin desenvolvido para WordPress que oferece uma solução de prontuário eletrônico voltada para profissionais de psicologia. Este plugin permite o gerenciamento completo dos registros de pacientes, consultas e informações clínicas, proporcionando um fluxo de trabalho simplificado e seguro para clínicas e consultórios.

## ⚙️ Funcionalidades

- **Gerenciamento de Pacientes:** Cadastro, visualização e atualização de informações dos pacientes.
- **Consultas e Anotações:** Registro detalhado de consultas, com anotações sobre o atendimento.
- **Encaminhamentos:** Gerenciamento de encaminhamentos para outros profissionais ou serviços.
- **Modal de Dados Clínicos:** Visualização e edição de informações clínicas de cada paciente.
- **Integração com Bookly:** Reutilização de dados da tabela `wp_bookly_customers` para preenchimento automático.

## 📦 Estrutura do Projeto

```plaintext
pronto-psi/
├── assets/
│   ├── css/
│   │   ├── admin-style.css
│   │   └── style.css
│   └── js/
│       ├── admin-script.js
│       └── script.js
├── includes/
│   ├── admin-menu.php
│   ├── functions.php
│   ├── shortcodes.php
│   ├── install.php
│   └── pages/
│       ├── prontuario.php
│       ├── atendimento.php
│       ├── anotações.php
│       └── encaminhamentos.php
│         └── modal/
│            ├── dados-clinicos.php
│            ├── functions_modal_dados_clinicos.php
└── pronto-psi.php
```

## 🚀 Instalação

1. Faça o download ou clone o repositório:
   ```bash
   git clone https://github.com/jucivanfreitas/pronto-psi.git
   ```

2. Mova o diretório `pronto-psi` para a pasta de plugins do WordPress (`/wp-content/plugins/`).

3. Ative o plugin através do painel de administração do WordPress, em **Plugins > Plugins Instalados**.

## 📝 Uso

1. Navegue até o menu **Pronto Psi** no painel do WordPress.
2. Utilize as funcionalidades para gerenciar pacientes, registrar consultas, anotações e gerenciar encaminhamentos.
3. Visualize e edite informações clínicas dos pacientes através do modal de dados clínicos.

## 🛠️ Requisitos

- WordPress 5.0 ou superior.
- PHP 7.4 ou superior.
- MySQL 5.7 ou superior.

## 🐞 Contribuições

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do repositório.
2. Crie um branch para sua feature (`git checkout -b feature/nome-da-feature`).
3. Commit suas alterações (`git commit -m 'Adicionei nova funcionalidade'`).
4. Faça um push para o branch (`git push origin feature/nome-da-feature`).
5. Abra um Pull Request.

## 📄 Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 📞 Contato

- **Autor:** Jucivan Freitas
- **Empresa:** DevDataVisio
- **Website:** [www.datavisio.store](https://www.datavisio.store)
