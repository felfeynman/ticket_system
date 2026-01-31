@extends('layouts.app')

@section('title', 'Gestão de Chamados')

@section('content')

<div class="container-fluid px-4">

    <!-- Título -->
<div class="page-title-box d-flex align-items-center justify-content-between">
    <h4 class="page-title">Gestão de Tickets</h4>

    <div class="d-flex flex-column gap-2">
        <button
            id="btn-new-ticket"
            class="btn btn-danger btn-sm rounded-pill shadow-sm px-3">
            + Novo Chamado
        </button>

        <button
            id="btn-new-category"
            class="btn btn-info btn-sm rounded-pill shadow-sm px-3">
            + Nova Categoria
        </button>

        <button id="btn-delete-category" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-3">
                − Deletar Categoria
        </button>

    </div>
</div>

    <!-- Filtros -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <select id="filter-status" class="form-select">
                        <option value="">Todos os status</option>
                        <option value="open">Aberto</option>
                        <option value="in_progress">Em progresso</option>
                        <option value="close">Fechado</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <select id="filter-category" class="form-select">
                        <option value="">Todas as categorias</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <button id="btn-filter" class="btn btn-info w-100">
                        Filtrar
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Nova Categoria -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Nova Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="category-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome da Categoria</label>
                        <input
                            type="text"
                            id="category-name"
                            class="form-control"
                            required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="btn btn-success">
                        Salvar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


    <!-- Tabela -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tickets-table">
                    <!-- AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    <!-- Modal Novo Chamado -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Novo Chamado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="ticket-form">
                        <input type="hidden" id="ticket-id">

                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" id="ticket-title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea id="ticket-description"
                                    class="form-control"
                                    rows="4"
                                    required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select id="ticket-category" class="form-select" required>
                                <!-- carregado via JS -->
                            </select>
                        </div>

                        <div class="mb-3" id="status-wrapper">
                             <label class="form-label">Status</label>
                                    <select id="ticket-status" class="form-select">
                                            <option value="open">Aberto</option>
                                            <option value="in_progress">Em progresso</option>
                                            <option value="close">Fechado</option>
                                    </select>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit"
                            form="ticket-form"
                            class="btn btn-success">
                        Salvar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Modal Deletar Categoria -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Deletar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning">
                    ⚠️ Esta ação não pode ser desfeita.
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select id="delete-category-select" class="form-select">
                        <!-- carregado via JS -->
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button
                    id="confirm-delete-category"
                    class="btn btn-danger">
                    Deletar
                </button>
            </div>

        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('assets/js/tickets.js') }}"></script>
@endpush
