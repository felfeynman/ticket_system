let ticketModal;

$(document).ready(function () {

    loadCategories();
    loadTickets();

    const modalEl = document.getElementById('ticketModal');
    ticketModal = new bootstrap.Modal(modalEl, {
        backdrop: 'static',
        keyboard: false
    });


    $('#btn-filter').on('click', function () {
        loadTickets();
    });

    $('#btn-new-ticket').on('click', function () {
        resetTicketForm();

        $('#ticket-id').val('');
        $('#status-wrapper').hide();
        $('#ticket-status').val('open');

        $('.modal-title').text('Novo Chamado');
        ticketModal.show();
    });


});

$(document).on('click', '.btn-edit-ticket', function () {
    let ticketId = $(this).data('id');
    openEditModal(ticketId);
});


$('#ticket-form').on('submit', function (e) {
    e.preventDefault();

    const ticketId = $('#ticket-id').val();

    const data = {
        title: $('#ticket-title').val(),
        description: $('#ticket-description').val(),
        category_id: $('#ticket-category').val(),
        //status: $('#ticket-status').val(),
    };

    if (ticketId) {
        data.status = $('#ticket-status').val();
        updateTicket(ticketId, data);
    } else {
        createTicket(data);
    }
});

$('#ticketModal').on('hidden.bs.modal', function () {
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
});



$('#btn-new-category').on('click', function () {
    $('#category-form')[0].reset();

    const modalEl = document.getElementById('categoryModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
});

$('#category-form').on('submit', function (e) {
    e.preventDefault();

    const data = {
        name: $('#category-name').val()
    };

    $.ajax({
        url: '/api/categories',
        method: 'POST',
        data: data,
        success: function () {

            const modalEl = document.getElementById('categoryModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            loadCategories();
        },
        error: function (xhr) {
            alert('Erro ao criar categoria');
            console.log(xhr.responseText);
        }
    });
});

/* ===============================
   Carregar categorias
================================ */
function loadCategories() {
    $.get('/api/categories', function (categories) {

        let filterselect = $('#filter-category');
        let modalselect = $('#ticket-category');

        filterselect.empty();
        filterselect.append('<option value="">Todas as categorias</option>');
        modalselect.empty().append('<option value="">Selecione</option>');


        categories.forEach(category => {
            filterselect.append(
                `<option value="${category.id}">${category.name}</option>`
            );
            modalselect.append(
                `<option value="${category.id}">${category.name}</option>`
            );
        });

    });
}


$('#btn-delete-category').on('click', function () {

    const select = $('#delete-category-select');
    select.empty();

    $('#filter-category option').each(function () {
        const value = $(this).val();
        const text = $(this).text();

        if (value) {
            select.append(`<option value="${value}">${text}</option>`);
        }
    });

    const modal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById('deleteCategoryModal')
    );
    modal.show();
});


$('#confirm-delete-category').on('click', function () {

    const categoryId = $('#delete-category-select').val();

    if (!categoryId) {
        alert('Selecione uma categoria');
        return;
    }

    $.ajax({
        url: `/api/categories/${categoryId}`,
        method: 'DELETE',
        success: function () {

            const modalEl = document.getElementById('deleteCategoryModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            loadCategories();
            loadTickets();
        },
        error: function (xhr) {
            alert(xhr.responseJSON?.message || 'Erro ao deletar categoria');
        }
    });
});



/* ===============================
   Carregar tickets (com filtros)
================================ */
function loadTickets() {

    let params = {
        status: $('#filter-status').val(),
        category_id: $('#filter-category').val()
    };

    $.get('/api/tickets', params, function (tickets) {

        console.log(tickets);

        let tbody = $('#tickets-table');
        tbody.empty();

        if (tickets.length === 0) {
            tbody.append(`
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Nenhum chamado encontrado
                    </td>
                </tr>
            `);
            return;
        }

        tickets.forEach(ticket => {
            tbody.append(buildTicketRow(ticket));
        });

    });
}

/* ===============================
   Montar linha da tabela
================================ */
function buildTicketRow(ticket) {

    let statusClass = {
        open: 'badge-soft-warning',
        in_progress: 'badge-soft-info',
        close: 'badge-soft-success'
    }[ticket.status];

    return `
        <tr>
            <td>#${ticket.id}</td>
            <td>${ticket.title}</td>
            <td>${ticket.category.name}</td>
            <td>
                <span class="badge ${statusClass} fw-semibold">
                    ${formatStatus(ticket.status)}
                </span>
            </td>
            <td class="text-center">
                <button class="btn btn-xs btn-light text-primary btn-edit-ticket" data-id="${ticket.id}">
                    Editar
                </button>
            </td>
        </tr>
    `;
}

function resetTicketForm() {
    $('#ticket-form')[0].reset();
}


/* ===============================
   Utils
================================ */
function formatStatus(status) {
    return {
        open: 'Aberto',
        in_progress: 'Em progresso',
        close: 'Fechado'
    }[status];
}

function openEditModal(ticketId) {

    $.get(`/api/tickets/${ticketId}`, function (ticket) {

        // Preencher campos
        $('#ticket-id').val(ticket.id);
        $('#ticket-title').val(ticket.title);
        $('#ticket-description').val(ticket.description);
        $('#ticket-category').val(ticket.category_id);

        $('#status-wrapper').show();
        $('#ticket-status').val(ticket.status);

        $('.modal-title').text('Editar Chamado');

        $('.modal-title').text('Editar Chamado');
        ticketModal.show();
    });
}

function updateTicket(id, data) {
    $.ajax({
        url: `/api/tickets/${id}`,
        method: 'PUT',
        data: data,
        success: function () {
            ticketModal.hide();
            loadTickets();
        }
    });
}

function createTicket(data) {
    $.post('/api/tickets', data, function () {
        ticketModal.hide();
        loadTickets();
    });
}
