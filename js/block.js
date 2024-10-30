var animation_classes = ["bounce",
"flash",
"pulse",
"rubberBand",
"shake",
"headShake",
"swing",
"tada",
"wobble",
"jello",
"bounceIn",
"bounceInDown",
"bounceInLeft",
"bounceInRight",
"bounceInUp",
"bounceOut",
"bounceOutDown",
"bounceOutLeft",
"bounceOutRight",
"bounceOutUp",
"fadeIn",
"fadeInDown",
"fadeInDownBig",
"fadeInLeft",
"fadeInLeftBig",
"fadeInRight",
"fadeInRightBig",
"fadeInUp",
"fadeInUpBig",
"fadeOut",
"fadeOutDown",
"fadeOutDownBig",
"fadeOutLeft",
"fadeOutLeftBig",
"fadeOutRight",
"fadeOutRightBig",
"fadeOutUp",
"fadeOutUpBig",
"flipInX",
"flipInY",
"flipOutX",
"flipOutY",
"lightSpeedIn",
"lightSpeedOut",
"rotateIn",
"rotateInDownLeft",
"rotateInDownRight",
"rotateInUpLeft",
"rotateInUpRight",
"rotateOut",
"rotateOutDownLeft",
"rotateOutDownRight",
"rotateOutUpLeft",
"rotateOutUpRight",
"hinge",
"jackInTheBox",
"rollIn",
"rollOut",
"zoomIn",
"zoomInDown",
"zoomInLeft",
"zoomInRight",
"zoomInUp",
"zoomOut",
"zoomOutDown",
"zoomOutLeft",
"zoomOutRight",
"zoomOutUp",
"slideInDown",
"slideInLeft",
"slideInRight",
"slideInUp",
"slideOutDown",
"slideOutLeft",
"slideOutRight",
"slideOutUp",
"heartBeat"];

var el = wp.element.createElement;
const { SelectControl, ToggleControl, PanelBody, PanelHeader, BaseControl } = wp.components;

const options = animation_classes.map(function(cvalue){
  return {label: cvalue, value: cvalue};
} );

options.unshift({label: 'Select',value: ""});
//console.log(options);

var withInspectorControls = wp.compose.createHigherOrderComponent( function( BlockEdit ) {
	return function( props ) {
		return el(
			wp.element.Fragment,
			{},
			el(
				BlockEdit,
				props
			),
			el(
				wp.editor.InspectorControls,
				{},
				el(
          PanelBody,
          {
            title: 'Animation setting'
          },
          el(
            SelectControl,
            {
              label: 'Animation',
              value: props.attributes.pisol_animation,
              options: options,
              onChange: function(value){ 
               
                let wow = "wow";
                let animated = "animated";
                let animation = value;
                
                if(typeof props.attributes.pisol_animation != 'undefined'){
                  let old_animation = props.attributes.pisol_animation;
                  let old_class = props.attributes.className;
                 
                  var r_oldanimation = old_class.replace(old_animation,"").trim();
                  var r_animated = r_oldanimation.replace(animated,"").trim();
                  var r_wow = r_animated.replace(wow,"").trim();

                  var new_class = (r_wow+" "+animation+" "+animated+" "+wow).trim();
                  
                }else{
                  var new_class = (animation+" "+animated+" "+wow).trim();
                }
                  
                  props.setAttributes( { className: new_class, pisol_animation: animation } ); 
              }
            }
          ),
        )
			)
		);
	};
	
}, 'withInspectorControls' );

wp.hooks.addFilter( 'editor.BlockEdit', 'brink/with-inspector-controls', withInspectorControls );


/* Adding all the animation class name using this variable */
const backgroundSettings = {
  pisol_animation: {
        type: "string",
    },
};

function addAttributes(settings) {
    const { assign } = lodash;
    settings.attributes = assign(settings.attributes, backgroundSettings);
    return settings;
}
wp.hooks.addFilter( 'blocks.registerBlockType', 'brink/add-attributes',  addAttributes );
