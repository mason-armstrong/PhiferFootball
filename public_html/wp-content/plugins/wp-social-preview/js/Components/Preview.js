import {Component} from '@wordpress/element';

export default class Preview extends Component {
    render() {
        const type = this.props.type || 'facebook';
        return (
            <div className={`wp-social-preview-share-preview wp-social-preview-share-preview-${type}`}>
                {this.props.imageUrl ? (
                    <div className="wp-social-preview-share-preview-image" style={{backgroundImage: `url('${this.props.imageUrl}')`}}/>
                ) : (
                    <div className="wp-social-preview-share-preview-image-empty"></div>
                )}
                <div className="wp-social-preview-share-preview-content">
                    <div className="wp-social-preview-share-preview-url">{this.props.url}</div>
                    <div className="wp-social-preview-share-preview-title">{this.props.title}</div>
                    <div className="wp-social-preview-share-preview-description">{this.props.description}</div>
                </div>
            </div>
        )
    }
}
