import {Component} from '@wordpress/element';
import Modal from 'react-modal';
import Preview from './Preview';
import SidebarTextControl from "./SidebarTextControl";
import SidebarTextareaControl from "./SidebarTextareaControl";
import SidebarMediaUploadControl from "./SidebarMediaUploadControl";

const customStyles = {
    overlay: {
        backgroundColor: 'rgba(0, 0, 0, 0.75)',
        zIndex: 99999
    },
    content: {
        top: '50%',
        left: '50%',
        right: 'auto',
        bottom: 'auto',
        transform: 'translate(-50%, -50%)',
        width: '100%',
        maxWidth: '902px',
        height: '100%',
        maxHeight: '70%',
        overflow: 'visible',
        padding: '0px',
        background: 'transparent',
        border: '0',
        borderRadius: '0'
    }
};

export default class PreviewModal extends Component {
    constructor(props) {
        super(props);
        this.state = {showModal: false};

        this.openModal = this.openModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
    }

    openModal() {
        this.setState({
            showModal: true
        });
    }

    closeModal() {
        this.setState({
            showModal: false
        });
    }

    render() {
        return (
            <div className="wp-social-preview-modal">
                <button className="components-button button" onClick={this.openModal}>View Full Size Previews</button>
                <Modal
                    isOpen={this.state.showModal}
                    onRequestClose={this.closeModal}
                    ariaHideApp={false}
                    style={customStyles}
                    contentLabel="WP Social Preview Modal"
                >
                    <button className="wp-social-preview-modal-close" onClick={this.closeModal}>
                        <span className="dashicons dashicons-no"></span>
                    </button>
                    <div className="wp-social-preview-modal-content">
                        <div className="wp-social-preview-modal-wrap">
                            <div className="wp-social-preview-modal-main">
                                <p>Facebook Preview:</p>
                                <Preview
                                    type="facebook"
                                    imageUrl={this.props.imageUrl}
                                    url={this.props.url}
                                    title={this.props.title}
                                    description={this.props.description}/>

                                <p>Twitter Preview:</p>
                                <Preview
                                    type="twitter"
                                    imageUrl={this.props.imageUrl}
                                    url={this.props.url}
                                    title={this.props.title}
                                    description={this.props.description}/>

                                <p>LinkedIn Preview:</p>
                                <Preview
                                    type="linkedin"
                                    imageUrl={this.props.imageUrl}
                                    url={this.props.url}
                                    title={this.props.title}
                                    description={this.props.description}/>

                                {this.props.imageUrl &&
                                    <>
                                        <p>Pinterest Preview:</p>
                                        <Preview
                                            type="pinterest"
                                            imageUrl={this.props.imageUrl}
                                            url={this.props.url}
                                            title={this.props.title}
                                            description={this.props.description}/>
                                    </>
                                }
                            </div>
                            <div className="wp-social-preview-modal-sidebar">
                                <p style={{margin: '0'}}><strong>Share Settings</strong></p>
                                <SidebarMediaUploadControl
                                    metaKey="wp_social_preview_image"
                                    label="Image"/>
                                <SidebarTextControl
                                    metaKey="wp_social_preview_title"
                                    label="Title"
                                    placeholder={this.props.placeholders.wp_social_preview_title}/>
                                <SidebarTextareaControl
                                    metaKey="wp_social_preview_description"
                                    label="Description"
                                    placeholder={this.props.placeholders.wp_social_preview_description}/>
                            </div>
                        </div>
                    </div>
                </Modal>
            </div>
        )
    }
}
