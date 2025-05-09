<?php
require 'includes/db.php';
require 'includes/functions.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener información del usuario
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Obtener archivos del usuario (excluyendo los eliminados)
$stmt = $db->prepare("SELECT * FROM archivos WHERE usuario_id = ? AND (eliminado IS NULL OR eliminado = 0) ORDER BY fecha_subida DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$files = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener espacio utilizado
$stmt = $db->prepare("SELECT espacio_utilizado, espacio_maximo FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

$used_space = $user_data['espacio_utilizado'];
$max_space = $user_data['espacio_maximo'];
$percentage_used = ($used_space / $max_space) * 100;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Nube - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--dark-color);
            color: white;
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .sidebar-logo i {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .sidebar-logo span {
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 600;
        }
        
        .user-name {
            font-size: 0.9rem;
        }
        
        .user-email {
            font-size: 0.8rem;
            opacity: 0.7;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: var(--transition);
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .menu-item.active {
            background-color: var(--primary-color);
        }
        
        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            flex: 1;
            background-color: #f5f7fa;
            padding: 30px;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 5px;
            padding: 8px 15px;
            width: 300px;
            box-shadow: var(--shadow);
        }
        
        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-family: 'Poppins', sans-serif;
        }
        
        .storage-info {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }
        
        .storage-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .storage-title {
            font-weight: 600;
        }
        
        .storage-used {
            font-size: 0.9rem;
            color: var(--gray-color);
        }
        
        .progress-bar {
            height: 10px;
            background-color: #f1f3f4;
            border-radius: 5px;
            margin-bottom: 10px;
            overflow: hidden;
        }
        
        .progress {
            height: 100%;
            background-color: var(--primary-color);
            border-radius: 5px;
            width: <?php echo $percentage_used; ?>%;
            transition: width 0.5s ease;
        }
        
        .storage-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--gray-color);
        }
        
        .files-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
        }
        
        .files-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .files-title {
            font-weight: 600;
        }
        
        .upload-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .upload-btn:hover {
            background-color: #3367d6;
        }
        
        .files-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .file-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            transition: var(--transition);
        }
        
        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .file-icon {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .file-icon i {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .file-name {
            font-weight: 500;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .file-size {
            font-size: 0.8rem;
            color: var(--gray-color);
            margin-bottom: 10px;
        }
        
        .file-actions {
            display: flex;
            justify-content: space-between;
        }
        
        .file-action {
            color: var(--gray-color);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .file-action:hover {
            color: var(--primary-color);
        }
        
        .upload-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .upload-modal {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-color);
        }
        
        .dropzone {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .dropzone:hover {
            border-color: var(--primary-color);
        }
        
        .dropzone i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .dropzone-text {
            margin-bottom: 10px;
        }
        
        .file-input {
            display: none;
        }
        
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .submit-btn:hover {
            background-color: #3367d6;
        }

        /* Nuevos estilos para modales */
        .share-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1001;
        }
        
        .share-modal .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
        }
        
        .share-modal .form-group {
            margin-bottom: 15px;
        }
        
        .share-modal label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .share-modal input[type="text"],
        .share-modal input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .share-modal button {
            padding: 8px 15px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        #copyLink {
            background-color: #f0f0f0;
        }
        
        #sendShare {
            background-color: var(--primary-color);
            color: white;
        }
        
        #closeShare {
            background-color: #f0f0f0;
        }
        
        .favorited {
            color: gold !important;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-cloud"></i>
                    <span>Mi Nube</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar"><?php echo strtoupper(substr($user_name, 0, 1)); ?></div>
                    <div>
                        <div class="user-name"><?php echo $user_name; ?></div>
                        <div class="user-email">Administrador</div>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
                <a href="#" id="uploadMenuBtn" class="menu-item">
                    <i class="fas fa-file-upload"></i>
                    <span>Subir Archivos</span>
                </a>
                <a href="shared.php" class="menu-item">
                    <i class="fas fa-share-alt"></i>
                    <span>Compartidos</span>
                </a>
                <a href="favorites.php" class="menu-item">
                    <i class="fas fa-star"></i>
                    <span>Favoritos</span>
                </a>
                <a href="trash.php" class="menu-item">
                    <i class="fas fa-trash"></i>
                    <span>Papelera</span>
                </a>
                <a href="profile.php" class="menu-item">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
                <a href="logout.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </div>
        <div class="main-content">
            <div class="top-bar">
                <h1 class="page-title">Mis Archivos</h1>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar archivos..." id="searchInput">
                </div>
            </div>
            
            <div class="storage-info">
                <div class="storage-header">
                    <div class="storage-title">Almacenamiento</div>
                    <div class="storage-used"><?php echo format_size($used_space); ?> de <?php echo format_size($max_space); ?> usado</div>
                </div>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                <div class="storage-details">
                    <div><?php echo number_format($percentage_used, 2); ?>% usado</div>
                    <div><?php echo format_size($max_space - $used_space); ?> disponible</div>
                </div>
            </div>
            
            <div class="files-container">
                <div class="files-header">
                    <h2 class="files-title">Todos los archivos</h2>
                    <button class="upload-btn" id="uploadBtn">
                        <i class="fas fa-plus"></i> Subir archivo
                    </button>
                </div>
                
                <?php if (count($files) > 0): ?>
                    <div class="files-grid" id="filesGrid">
                        <?php foreach ($files as $file): 
                            $file_icon = get_file_icon($file['tipo']);
                        ?>
                            <div class="file-card" data-file-id="<?php echo $file['id']; ?>">
                                <div class="file-icon">
                                    <i class="fas <?php echo $file_icon; ?>"></i>
                                </div>
                                <div class="file-name"><?php echo htmlspecialchars($file['nombre_original']); ?></div>
                                <div class="file-size"><?php echo format_size($file['tamano']); ?></div>
                                <div class="file-date"><?php echo date('d/m/Y', strtotime($file['fecha_subida'])); ?></div>
                                <div class="file-actions">
                                    <i class="fas fa-download file-action" title="Descargar"></i>
                                    <i class="fas fa-share-alt file-action" title="Compartir"></i>
                                    <i class="fas fa-star file-action <?php echo $file['es_favorito'] ? 'favorited' : ''; ?>" 
                                       title="<?php echo $file['es_favorito'] ? 'Quitar de favoritos' : 'Agregar a favoritos'; ?>" 
                                       style="<?php echo $file['es_favorito'] ? 'color: gold;' : ''; ?>"></i>
                                    <i class="fas fa-trash file-action" title="Mover a papelera"></i>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 40px 0;">
                        <i class="fas fa-folder-open" style="font-size: 3rem; color: #ddd; margin-bottom: 15px;"></i>
                        <p style="color: var(--gray-color);">No hay archivos subidos todavía</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Modal para subir archivos -->
    <div class="upload-form" id="uploadForm">
        <div class="upload-modal">
            <div class="modal-header">
                <h2 class="modal-title">Subir archivos</h2>
                <button class="close-btn" id="closeBtn">&times;</button>
            </div>
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="dropzone" id="fileDropzone">
                <i class="fas fa-cloud-upload-alt"></i>
                <div class="dropzone-text">Arrastra y suelta tus archivos aquí</div>
                <div class="dropzone-text">o</div>
                <button type="button" class="btn-primary" id="browseBtn">Seleccionar archivos</button>
                <input type="file" name="files[]" id="fileInput" class="file-input" multiple>
            </form>
            <button type="submit" class="submit-btn" id="submitBtn">Subir archivos</button>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const uploadBtn = document.getElementById('uploadBtn');
            const uploadMenuBtn = document.getElementById('uploadMenuBtn');
            const uploadForm = document.getElementById('uploadForm');
            const closeBtn = document.getElementById('closeBtn');
            const browseBtn = document.getElementById('browseBtn');
            const fileInput = document.getElementById('fileInput');
            const submitBtn = document.getElementById('submitBtn');
            const dropzone = document.getElementById('fileDropzone');
            const searchInput = document.getElementById('searchInput');
            const filesGrid = document.getElementById('filesGrid');
            
            // Mostrar formulario de subida
            function showUploadForm() {
                uploadForm.style.display = 'flex';
            }
            
            uploadBtn.addEventListener('click', showUploadForm);
            uploadMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showUploadForm();
            });
            
            // Ocultar formulario
            closeBtn.addEventListener('click', function() {
                uploadForm.style.display = 'none';
            });
            
            // Seleccionar archivos
            browseBtn.addEventListener('click', function() {
                fileInput.click();
            });
            
            // Manejar la selección de archivos
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    submitBtn.disabled = false;
                }
            });
            
            // Manejar el drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropzone.style.borderColor = 'var(--primary-color)';
                dropzone.style.backgroundColor = 'rgba(66, 133, 244, 0.1)';
            }
            
            function unhighlight() {
                dropzone.style.borderColor = '#ddd';
                dropzone.style.backgroundColor = 'transparent';
            }
            
            // Manejar archivos soltados
            dropzone.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                
                if (files.length > 0) {
                    submitBtn.disabled = false;
                }
            }
            
            // Manejar subida de archivos
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (fileInput.files.length === 0) {
                    alert('Por favor selecciona al menos un archivo');
                    return;
                }
                
                const formData = new FormData();
                for (let i = 0; i < fileInput.files.length; i++) {
                    formData.append('files[]', fileInput.files[i]);
                }
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subiendo...';
                
                fetch('upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Archivos subidos correctamente');
                        location.reload();
                    } else {
                        let errorMsg = 'Algunos archivos no se pudieron subir:\n';
                        for (const file in data.errors) {
                            errorMsg += `${file}: ${data.errors[file]}\n`;
                        }
                        alert(errorMsg);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al subir los archivos');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Subir archivos';
                    uploadForm.style.display = 'none';
                    fileInput.value = '';
                });
            });
            
            // Búsqueda en tiempo real
            if (searchInput && filesGrid) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const fileCards = filesGrid.querySelectorAll('.file-card');
                    
                    fileCards.forEach(card => {
                        const fileName = card.querySelector('.file-name').textContent.toLowerCase();
                        if (fileName.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            
            // Manejar descarga de archivos
            document.querySelectorAll('.fa-download').forEach(icon => {
                icon.addEventListener('click', function() {
                    const fileCard = this.closest('.file-card');
                    const fileId = fileCard.getAttribute('data-file-id');
                    const fileName = fileCard.querySelector('.file-name').textContent;
                    
                    fetch(`download.php?id=${fileId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la descarga');
                            }
                            return response.blob();
                        })
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = fileName;
                            document.body.appendChild(a);
                            a.click();
                            window.URL.revokeObjectURL(url);
                            document.body.removeChild(a);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al descargar el archivo');
                        });
                });
            });
            
            // Manejar compartir archivos
            document.querySelectorAll('.fa-share-alt').forEach(icon => {
                icon.addEventListener('click', function() {
                    const fileCard = this.closest('.file-card');
                    const fileId = fileCard.getAttribute('data-file-id');
                    const fileName = fileCard.querySelector('.file-name').textContent;
                    
                    // Crear modal para compartir
                    const shareModal = document.createElement('div');
                    shareModal.className = 'share-modal';
                    shareModal.innerHTML = `
                        <div class="modal-content">
                            <h3>Compartir archivo: ${fileName}</h3>
                            <div class="form-group">
                                <label>Enlace de compartir:</label>
                                <div style="display: flex;">
                                    <input type="text" id="shareLink" readonly style="flex: 1;">
                                    <button id="copyLink" style="margin-left: 10px;">Copiar</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Correo electrónico:</label>
                                <input type="email" id="shareEmail" placeholder="Ingresa el correo del destinatario">
                            </div>
                            <div style="margin-top: 20px;">
                                <button id="sendShare" class="btn-primary">Enviar</button>
                                <button id="closeShare">Cancelar</button>
                            </div>
                        </div>
                    `;
                    
                    document.body.appendChild(shareModal);
                    
                    // Generar enlace de compartir
                    const shareLink = `${window.location.origin}/share.php?id=${fileId}`;
                    document.getElementById('shareLink').value = shareLink;
                    
                    // Configurar eventos
                    document.getElementById('copyLink').addEventListener('click', function() {
                        const linkInput = document.getElementById('shareLink');
                        linkInput.select();
                        document.execCommand('copy');
                        alert('Enlace copiado al portapapeles');
                    });
                    
                    document.getElementById('sendShare').addEventListener('click', function() {
                        const email = document.getElementById('shareEmail').value;
                        if (!email) {
                            alert('Por favor ingresa un correo electrónico');
                            return;
                        }
                        
                        // Enviar el correo (simulado)
                        fetch('share.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                file_id: fileId,
                                email: email
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(`Se ha enviado el enlace a ${email}`);
                                document.body.removeChild(shareModal);
                            } else {
                                alert('Error al enviar el correo');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al enviar el correo');
                        });
                    });
                    
                    document.getElementById('closeShare').addEventListener('click', function() {
                        document.body.removeChild(shareModal);
                    });
                });
            });
            
            // Manejar favoritos
            document.querySelectorAll('.fa-star').forEach(icon => {
                icon.addEventListener('click', function() {
                    const fileCard = this.closest('.file-card');
                    const fileId = fileCard.getAttribute('data-file-id');
                    const isFavorite = this.classList.contains('favorited');
                    
                    fetch('favorite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            file_id: fileId,
                            action: isFavorite ? 'remove' : 'add'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.toggle('favorited');
                            this.style.color = this.classList.contains('favorited') ? 'gold' : '';
                            this.title = this.classList.contains('favorited') ? 'Quitar de favoritos' : 'Agregar a favoritos';
                        } else {
                            alert('Error al actualizar favoritos');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al actualizar favoritos');
                    });
                });
            });
            
            // Manejar papelera (eliminar archivos)
            document.querySelectorAll('.fa-trash').forEach(icon => {
                icon.addEventListener('click', function() {
                    if (!confirm('¿Estás seguro de que quieres mover este archivo a la papelera?')) {
                        return;
                    }
                    
                    const fileCard = this.closest('.file-card');
                    const fileId = fileCard.getAttribute('data-file-id');
                    
                    fetch('trash.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            file_id: fileId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fileCard.remove();
                            alert('Archivo movido a la papelera');
                        } else {
                            alert('Error al mover a la papelera');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al mover a la papelera');
                    });
                });
            });
        });
    </script>
</body>
</html>