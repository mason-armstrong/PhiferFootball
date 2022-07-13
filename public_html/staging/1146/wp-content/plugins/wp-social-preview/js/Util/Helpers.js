import {select} from "@wordpress/data";

export function optional(obj, ...args) {
    return args.reduce((obj, level) => (obj && obj[level]) ? obj[level] : null, obj);
}

export function getAttachmentUrl(attachmentId, size = 'wp_social_preview_default') {
    if (!attachmentId) {
        return null;
    }

    const attachment = select('core').getMedia(attachmentId);
    if (!attachment) {
        return null;
    }

    let url = optional(attachment, 'media_details', 'sizes', size, 'source_url');
    if (!url) {
        url = optional(attachment, 'media_details', 'sizes', 'thumbnail', 'source_url');
    }

    return url;
}

export default {
    optional,
    getAttachmentUrl,
}
