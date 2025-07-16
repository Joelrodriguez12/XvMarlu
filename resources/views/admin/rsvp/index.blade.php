@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Confirmaciones de Asistencia</h1>
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Invitados</h3>
                    <p class="stat-number">{{ \App\Models\Rsvp::getTotalGuests() }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>Confirmaciones</h3>
                    <p class="stat-number">{{ \App\Models\Rsvp::getTotalConfirmations() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="rsvp-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Invitados</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsvps as $rsvp)
                    <tr>
                        <td>{{ $rsvp->name }}</td>
                        <td>{{ $rsvp->phone }}</td>
                        <td class="text-center">{{ $rsvp->guests }}</td>
                        <td>{{ $rsvp->message ?: '-' }}</td>
                        <td>{{ $rsvp->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.rsvp.destroy', $rsvp->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta confirmación?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-message">No hay confirmaciones aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $rsvps->links() }}
    </div>

    <div class="export-section">
        <button class="btn-export" onclick="exportToCSV()">
            <i class="fas fa-download"></i> Exportar a CSV
        </button>
    </div>
</div>

<style>
.admin-container {
    max-width: 1200px;
    margin: 100px auto 50px;
    padding: 0 20px;
}

.admin-header {
    margin-bottom: 40px;
}

.admin-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 30px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    background: #d4a574;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content h3 {
    font-size: 1rem;
    color: #666;
    margin-bottom: 5px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 600;
    color: #333;
}

.alert {
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.rsvp-table {
    width: 100%;
    border-collapse: collapse;
}

.rsvp-table thead {
    background: #f8f8f8;
}

.rsvp-table th {
    padding: 20px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e0e0e0;
}

.rsvp-table td {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.rsvp-table tbody tr:hover {
    background: #fafafa;
}

.text-center {
    text-align: center;
}

.btn-delete {
    background: #f44336;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-delete:hover {
    background: #d32f2f;
}

.empty-message {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px !important;
}

.pagination-container {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.export-section {
    margin-top: 40px;
    text-align: center;
}

.btn-export {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-export:hover {
    background: #45a049;
}

.btn-export i {
    margin-right: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    .rsvp-table {
        font-size: 0.9rem;
    }
    
    .rsvp-table th,
    .rsvp-table td {
        padding: 10px;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<script>
function exportToCSV() {
    // Get table data
    const table = document.querySelector('.rsvp-table');
    const rows = table.querySelectorAll('tr');
    let csv = [];
    
    // Add headers
    const headers = [];
    rows[0].querySelectorAll('th').forEach(th => {
        if (th.textContent !== 'Acciones') {
            headers.push(th.textContent);
        }
    });
    csv.push(headers.join(','));
    
    // Add data rows
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].querySelectorAll('td');
        if (cells.length > 1) { // Skip empty rows
            const rowData = [];
            for (let j = 0; j < cells.length - 1; j++) { // Skip actions column
                rowData.push(`"${cells[j].textContent.trim()}"`);
            }
            csv.push(rowData.join(','));
        }
    }
    
    // Download CSV
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `confirmaciones_xv_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection