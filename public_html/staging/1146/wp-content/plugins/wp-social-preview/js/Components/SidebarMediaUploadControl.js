import {withSelect, withDispatch} from '@wordpress/data';
import {compose} from '@wordpress/compose';
import {Button} from '@wordpress/components';
import {MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';
import {getAttachmentUrl} from '../Util/Helpers';

export default compose(
    withSelect((select, props) => {
        const attachmentId = select('core/editor').getEditedPostAttribute('meta')[props.metaKey];

        return {
            value: attachmentId,
            url: getAttachmentUrl(attachmentId),
        }
    }),
    withDispatch((dispatch, props) => {
        return {
            setValue: function (value) {
                dispatch('core/editor').editPost({
                    meta: {[props.metaKey]: value}
                });
            }
        }
    }),
)(props => {
    return (
        <div class="components-base-control">
            <div className="components-base-control__field">
                <label className="components-base-control__label">{props.label}</label>
                <div className="wp-social-preview-sidebar-media-upload-control">
                    {props.url &&
                    <div>
                        <img src={props.url} alt=""/>
                    </div>
                    }
                    <div>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) => props.setValue(media.id)}
                                allowedTypes={['image']}
                                value={props.value}
                                render={({open}) => (
                                    <Button className="button" onClick={open}>
                                        Choose Image
                                    </Button>
                                )}
                            />
                        </MediaUploadCheck>
                        {props.url &&
                        <Button
                            isLink
                            isDestructive
                            onClick={() => props.setValue(null)}>
                            Remove Image
                        </Button>
                        }
                    </div>
                </div>
            </div>
        </div>
    )
});
