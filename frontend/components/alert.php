<?php
function renderAlert($message, $type = 'info') {
    // Determinar el color basado en el tipo de alerta
    $colorClass = match($type) {
        'success' => 'bg-green-50 text-green-800 border-green-300',
        'error' => 'bg-red-50 text-red-800 border-red-300',
        'warning' => 'bg-yellow-50 text-yellow-800 border-yellow-300',
        'info' => 'bg-blue-50 text-blue-800 border-blue-300',
        default => 'bg-gray-50 text-gray-800 border-gray-300',
    };
    
    // Renderizar el HTML de la alerta
    echo "
    <div class='p-4 mb-4 text-sm {$colorClass} border rounded'>
        <strong class='font-semibold'>Alerta:</strong> {$message}
    </div>
    ";
}
?>
