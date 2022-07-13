import {registerPlugin} from '@wordpress/plugins';
import {withSelect, withDispatch} from "@wordpress/data";
import {compose} from '@wordpress/compose';
import {PluginSidebar, PluginSidebarMoreMenuItem} from '@wordpress/edit-post';
import {Panel, PanelBody, PanelRow} from '@wordpress/components';
import SidebarTextControl from './Components/SidebarTextControl';
import SidebarTextareaControl from './Components/SidebarTextareaControl';
import SidebarMediaUploadControl from './Components/SidebarMediaUploadControl';
import Preview from './Components/Preview';
import PreviewModal from './Components/PreviewModal';
import {getAttachmentUrl} from './Util/Helpers';

const WPSocialPreviewEditorSidebar = compose(
    withSelect(select => {
        tmp = document.createElement('a');
        tmp.href = select('core/editor').getPermalink();
        const hostname = tmp.hostname;

        const postContent = select('core/editor').getEditedPostContent();
        let tmp = document.createElement('div');
        tmp.innerHTML = postContent; // Strip HTML tags
        let postExcerpt = (tmp.textContent || tmp.innerText || '').replace("\n", '');
        if (postExcerpt.length > 100) {
            postExcerpt = postExcerpt.substring(0, 100) + '...';
        }

        let attachmentId = select('core/editor').getEditedPostAttribute('meta')['wp_social_preview_image'];
        if (!attachmentId) {
            attachmentId = select('core/editor').getEditedPostAttribute('featured_media');
        }
        if (!attachmentId) {
            attachmentId = window.WPSocialPreview.fallback_image;
        }

        return {
            hostname: hostname,
            meta: select('core/editor').getEditedPostAttribute('meta'),
            placeholder: {
                wp_social_preview_title: select('core/editor').getEditedPostAttribute('title'),
                wp_social_preview_description: postExcerpt,
            },
            imageUrl: getAttachmentUrl(attachmentId),
        }
    }),
)(props => {
    const previewTitle = props.meta.wp_social_preview_title || props.placeholder.wp_social_preview_title;
    const previewDescription = props.meta.wp_social_preview_description || props.placeholder.wp_social_preview_description;
    return (
        <PluginSidebar
            name="wp-social-preview-editor-sidebar"
            className="wp-social-preview-editor-sidebar"
            title="WP Social Preview"
            icon="share-alt2"
        >
            <Panel>
                <PanelBody
                    title="Share Settings"
                    initialOpen={true}
                >
                    <PanelRow>
                        <div>
                            <a href="https://ogp.me/" target="_blank">Open Graph</a> meta tags are used to generate rich
                            previews when content is shared on social media. Use these settings to override the meta
                            tags for this content.
                        </div>
                    </PanelRow>
                    <PanelRow>
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <label className="components-base-control__label">Preview</label>
                                <Preview
                                    imageUrl={props.imageUrl}
                                    url={props.hostname}
                                    title={previewTitle}
                                    description={previewDescription}/>
                                <br/>
                                <PreviewModal
                                    imageUrl={props.imageUrl}
                                    url={props.hostname}
                                    title={previewTitle}
                                    description={previewDescription}
                                    placeholders={props.placeholder}/>
                            </div>
                        </div>
                    </PanelRow>
                    <PanelRow>
                        <SidebarMediaUploadControl
                            metaKey="wp_social_preview_image"
                            label="Image"/>
                    </PanelRow>
                    <PanelRow>
                        <SidebarTextControl
                            metaKey="wp_social_preview_title"
                            label="Title"
                            placeholder={props.placeholder.wp_social_preview_title}/>
                    </PanelRow>
                    <PanelRow>
                        <SidebarTextareaControl
                            metaKey="wp_social_preview_description"
                            label="Description"
                            placeholder={props.placeholder.wp_social_preview_description}/>
                    </PanelRow>
                </PanelBody>
            </Panel>
        </PluginSidebar>
    )
});

registerPlugin('wp-social-preview-editor-sidebar', {
    render: () => {
        return (
            <>
                <PluginSidebarMoreMenuItem
                    target="wp-social-preview-editor-sidebar"
                    icon="share-alt2">
                    WP Social Preview
                </PluginSidebarMoreMenuItem>
                <WPSocialPreviewEditorSidebar/>
            </>
        )
    }
});
