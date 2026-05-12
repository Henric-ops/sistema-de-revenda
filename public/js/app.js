function cobrarWhatsApp(telefone, nome, valor) {
    telefone = telefone.replace(/\D/g, "");

    if (!telefone.startsWith("55")) {
        telefone = "55" + telefone;
    }

    let mensagem =
        "Olá " +
        nome +
        " 👋\n\n" +
        "📌 Estou entrando em contato para lembrar sobre sua compra pendente.\n\n" +
        "💰 Valor em aberto: R$ " +
        valor +
        "\n\n" +
        "Poderia verificar o pagamento, por favor? 😊";

    let url =
        "https://api.whatsapp.com/send?phone=" +
        telefone +
        "&text=" +
        encodeURIComponent(mensagem);

    window.open(url, "_blank");
}
