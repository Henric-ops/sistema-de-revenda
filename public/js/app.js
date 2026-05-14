function cobrarWhatsApp(telefone, nome, valor, produtos) {

    telefone = telefone.replace(/\D/g, "");

    if (!telefone.startsWith("55")) {
        telefone = "55" + telefone;
    }

    let mensagem =
        "Oii, " + nome + "!" + " Tudo bem? 😊 \n\n" +
        "Estou passando sobre sua compra:\n\n" +
        "🛍️ " + produtos + "\n\n" +
        "💳 Valor: *R$ " + valor + "*\n\n" +
        "Quando puder, me dá um retorno sobre o acerto do pagamento, tá bom? Obrigada! 🙏";

    let url =
        "https://api.whatsapp.com/send?phone=" +
        telefone +
        "&text=" +
        encodeURIComponent(mensagem);

    window.open(url, "_blank");
}