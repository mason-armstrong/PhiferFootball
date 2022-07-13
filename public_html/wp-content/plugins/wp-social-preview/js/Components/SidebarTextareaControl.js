import {withSelect, withDispatch} from '@wordpress/data';
import {compose} from '@wordpress/compose';
import {TextareaControl} from '@wordpress/components';

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
        <TextareaControl
            label={props.label}
            value={props.value}
            placeholder={placeholder}
            help={help}
            onChange={value => props.setValue(value)}
        />
    )
});
