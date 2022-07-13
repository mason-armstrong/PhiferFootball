import {withSelect, withDispatch} from '@wordpress/data';
import {compose} from '@wordpress/compose';
import {TextControl} from '@wordpress/components';

export default compose(
    withSelect((select, props) => {
        return {
            value: select('core/editor').getEditedPostAttribute('meta')[props.metaKey]
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
    const placeholder = props.placeholder || '';
    const help = props.help || '';
    return (
        <TextControl
            label={props.label}
            value={props.value}
            placeholder={placeholder}
            help={help}
            onChange={value => props.setValue(value)}
        />
    )
});
