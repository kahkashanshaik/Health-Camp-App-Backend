import './bootstrap';
import './choices.js';
import 'laravel-datatables-vite';
import PerfectScrollbar from 'perfect-scrollbar';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';
import UI from '@alpinejs/ui';
import './popper.min.js';
import Alpine from 'alpinejs';

import { FileUploadWithPreview, Events } from 'file-upload-with-preview';

Alpine.plugin(collapse);
Alpine.plugin(persist);
Alpine.plugin(UI);
Alpine.plugin(focus);
window.Alpine = Alpine;
window.FileUploadWithPreview = FileUploadWithPreview;
Alpine.start();
import './custom.js';

// perfect scrollbar
const initPerfectScrollbar = () => {
    const container = document.querySelectorAll('.perfect-scrollbar');
    for (let i = 0; i < container.length; i++) {
        new PerfectScrollbar(container[i], {
            wheelPropagation: true,
            // suppressScrollX: true,
        });
    }
};
initPerfectScrollbar();
// File Upload With Preview
window.initializeImagePreviewWidget = function(id, path = null, bgImg) {
    const fileInstance = new FileUploadWithPreview(id, {
        images: {
            baseImage: path ?? "/assets/images/file-preview.svg",
            backgroundImage: '',
        },
    });
}

window.addEventListener(Events.IMAGE_ADDED, (e) => {
    const { detail } = e;
    const ele = document.getElementById('file-upload-with-preview-' + detail.uploadId)
    ele.name = detail.uploadId;
    const file = detail.cachedFileArray[0];
});
