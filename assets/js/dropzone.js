/**
 * Dropzone.js
 * Versión simplificada para el proyecto Mi Nube
 */

class Dropzone {
    constructor(element, options = {}) {
        this.element = typeof element === 'string' ? document.querySelector(element) : element;
        this.options = {
            url: '/upload',
            paramName: 'file',
            maxFilesize: 100, // MB
            acceptedFiles: null,
            addRemoveLinks: false,
            autoProcessQueue: true,
            ...options
        };

        this.files = [];
        this.init();
    }

    init() {
        this.setupEventListeners();
    }

    setupEventListeners() {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            this.element.addEventListener(eventName, this.preventDefaults.bind(this), false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            this.element.addEventListener(eventName, this.highlight.bind(this), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            this.element.addEventListener(eventName, this.unhighlight.bind(this), false);
        });

        this.element.addEventListener('drop', this.handleDrop.bind(this), false);

        // Si hay un input file
        const fileInput = this.element.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', this.handleInputChange.bind(this), false);
        }
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    highlight() {
        this.element.classList.add('dz-drag-hover');
    }

    unhighlight() {
        this.element.classList.remove('dz-drag-hover');
    }

    handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        this.handleFiles(files);
    }

    handleInputChange(e) {
        const files = e.target.files;
        this.handleFiles(files);
    }

    handleFiles(files) {
        [...files].forEach(file => {
            this.addFile(file);
        });

        if (this.options.autoProcessQueue) {
            this.processQueue();
        }
    }

    addFile(file) {
        // Validar tamaño del archivo
        if (this.options.maxFilesize && file.size > this.options.maxFilesize * 1024 * 1024) {
            this.emit('error', file, `El archivo es demasiado grande (${(file.size / (1024 * 1024)).toFixed(2)} MB). Tamaño máximo: ${this.options.maxFilesize} MB`);
            return;
        }

        // Validar tipo de archivo
        if (this.options.acceptedFiles) {
            const acceptedTypes = this.options.acceptedFiles.split(',');
            const fileType = file.type;
            const fileName = file.name.toLowerCase();
            
            const isAccepted = acceptedTypes.some(type => {
                type = type.trim().toLowerCase();
                if (type.startsWith('.')) {
                    return fileName.endsWith(type);
                } else if (type.includes('/*')) {
                    const mainType = type.split('/*')[0];
                    return fileType.startsWith(mainType);
                } else {
                    return fileType === type;
                }
            });

            if (!isAccepted) {
                this.emit('error', file, 'Tipo de archivo no permitido');
                return;
            }
        }

        this.files.push(file);
        this.emit('addedfile', file);
    }

    processQueue() {
        this.files.forEach(file => {
            this.uploadFile(file);
        });
    }

    uploadFile(file) {
        const formData = new FormData();
        formData.append(this.options.paramName, file);

        this.emit('sending', file);

        fetch(this.options.url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la subida');
            }
            return response.json();
        })
        .then(data => {
            this.emit('success', file, data);
            this.emit('complete', file);
        })
        .catch(error => {
            this.emit('error', file, error.message);
            this.emit('complete', file);
        });
    }

    removeFile(file) {
        this.files = this.files.filter(f => f !== file);
        this.emit('removedfile', file);
    }

    emit(event, ...args) {
        const customEvent = new CustomEvent(`dropzone:${event}`, { 
            detail: args,
            bubbles: true
        });
        this.element.dispatchEvent(customEvent);
    }
}

// Inicialización automática para elementos con data-dropzone
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-dropzone]').forEach(element => {
        new Dropzone(element, {
            url: element.getAttribute('data-url') || '/upload',
            paramName: element.getAttribute('data-param-name') || 'file',
            maxFilesize: element.getAttribute('data-max-filesize') || 100,
            acceptedFiles: element.getAttribute('data-accepted-files'),
            addRemoveLinks: element.hasAttribute('data-add-remove-links'),
            autoProcessQueue: !element.hasAttribute('data-no-auto-queue')
        });
    });
});

// Exportar para uso modular
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = Dropzone;
} else {
    window.Dropzone = Dropzone;
}