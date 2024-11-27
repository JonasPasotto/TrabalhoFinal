document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#formChamado');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Captura os valores dos campos
        const nome = document.querySelector('#nome').value;
        const setor = document.querySelector('#setor').value;
        const descricao = document.querySelector('#descricao').value;
        const observacoes = document.querySelector('#observacoes').value;

        // Cria um objeto com os dados
        const chamado = {
            nome: nome,
            setor: setor,
            descricao: descricao,
            observacoes: observacoes,
            data_criacao: new Date().toLocaleString() // Adiciona a data de criação
        };

        // Verifica se já existe um chamado salvo no localStorage
        let chamadosSalvos = JSON.parse(localStorage.getItem('chamados')) || [];

        // Adiciona o novo chamado à lista
        chamadosSalvos.push(chamado);

        // Salva os dados no localStorage
        localStorage.setItem('chamados', JSON.stringify(chamadosSalvos));

        // Exibe uma mensagem de sucesso
        alert('Chamado enviado com sucesso!');

        // Limpa o formulário
        form.reset();
    });
   
});
