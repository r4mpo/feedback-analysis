📊 **Feedback Analysis**

Este projeto utiliza **PHP 8.3**, **Docker** e **TransformersPHP** para análise de sentimentos e tradução de textos. O frontend conta com **JavaScript** e **jQuery** para interações assíncronas.

---

## 🛠 Requisitos

* 🐘 PHP 8.3
* 🐳 Docker e Docker Compose
* 💻 JavaScript (jQuery)

---

## 🚀 Instalação

1️⃣ Clone o repositório:

```bash
git clone https://github.com/r4mpo/feedback-analysis.git
cd feedback-analysis/docker
```

2️⃣ Limpe containers e imagens antigas (opcional, mas recomendado):

```bash
docker-compose down --remove-orphans
docker image prune -f
```

3️⃣ Construa a imagem do Docker:

```bash
docker-compose build --no-cache
```

4️⃣ Inicie os containers:

```bash
docker-compose up
```

---

## 🌐 Acesse a aplicação

Após iniciar os containers, abra no navegador:

```
http://localhost:8000/
```

---

## 💡 Observações

* Certifique-se de que o Docker tenha **memória suficiente** para executar modelos grandes do TransformersPHP.
* O frontend utiliza chamadas **síncronas via jQuery Ajax** para evitar timeout em requisições longas.
* Se ocorrerem problemas de timeout ou memória, ajuste no Dockerfile:

  * `memory_limit`
  * `max_execution_time`

---

✨ Divirta-se analisando sentimentos com IA!