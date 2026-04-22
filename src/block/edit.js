import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	TextControl,
	RangeControl,
	__experimentalToggleGroupControl as ToggleGroupControl,
	__experimentalToggleGroupControlOption as ToggleGroupControlOption,
	Placeholder,
} from '@wordpress/components';

const ALLOWED = [ 'image' ];

function ImagePicker( { label, image, onSelect, onRemove } ) {
	return (
		<div className="wpba-picker">
			<strong>{ label }</strong>
			<MediaUploadCheck>
				<MediaUpload
					allowedTypes={ ALLOWED }
					value={ image?.id }
					onSelect={ ( media ) =>
						onSelect( {
							id: media.id,
							url: media.url,
							alt: media.alt || '',
						} )
					}
					render={ ( { open } ) => (
						<div className="wpba-picker__inner">
							{ image?.url ? (
								<img
									src={ image.url }
									alt={ image.alt || '' }
									className="wpba-picker__preview"
								/>
							) : (
								<div className="wpba-picker__empty">
									{ __( 'No image selected', 'wpba' ) }
								</div>
							) }
							<div className="wpba-picker__actions">
								<Button variant="secondary" onClick={ open }>
									{ image?.url
										? __( 'Replace', 'wpba' )
										: __( 'Select image', 'wpba' ) }
								</Button>
								{ image?.url && (
									<Button variant="tertiary" isDestructive onClick={ onRemove }>
										{ __( 'Remove', 'wpba' ) }
									</Button>
								) }
							</div>
						</div>
					) }
				/>
			</MediaUploadCheck>
		</div>
	);
}

export default function Edit( { attributes, setAttributes } ) {
	const {
		beforeImage = {},
		afterImage = {},
		beforeLabel,
		afterLabel,
		orientation,
		startPosition,
	} = attributes;

	const blockProps = useBlockProps( {
		className: `wpba-editor wpba-editor--${ orientation }`,
	} );

	const hasBoth = beforeImage?.url && afterImage?.url;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Images', 'wpba' ) } initialOpen>
					<ImagePicker
						label={ __( 'Before image', 'wpba' ) }
						image={ beforeImage }
						onSelect={ ( img ) => setAttributes( { beforeImage: img } ) }
						onRemove={ () => setAttributes( { beforeImage: {} } ) }
					/>
					<ImagePicker
						label={ __( 'After image', 'wpba' ) }
						image={ afterImage }
						onSelect={ ( img ) => setAttributes( { afterImage: img } ) }
						onRemove={ () => setAttributes( { afterImage: {} } ) }
					/>
					<TextControl
						label={ __( 'Before alt text', 'wpba' ) }
						value={ beforeImage?.alt || '' }
						onChange={ ( val ) =>
							setAttributes( {
								beforeImage: { ...beforeImage, alt: val },
							} )
						}
					/>
					<TextControl
						label={ __( 'After alt text', 'wpba' ) }
						value={ afterImage?.alt || '' }
						onChange={ ( val ) =>
							setAttributes( {
								afterImage: { ...afterImage, alt: val },
							} )
						}
					/>
				</PanelBody>

				<PanelBody title={ __( 'Labels', 'wpba' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'Before label', 'wpba' ) }
						value={ beforeLabel }
						onChange={ ( val ) => setAttributes( { beforeLabel: val } ) }
					/>
					<TextControl
						label={ __( 'After label', 'wpba' ) }
						value={ afterLabel }
						onChange={ ( val ) => setAttributes( { afterLabel: val } ) }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Slider', 'wpba' ) } initialOpen={ false }>
					<ToggleGroupControl
						label={ __( 'Orientation', 'wpba' ) }
						value={ orientation }
						isBlock
						onChange={ ( val ) => setAttributes( { orientation: val } ) }
					>
						<ToggleGroupControlOption
							value="horizontal"
							label={ __( 'Horizontal', 'wpba' ) }
						/>
						<ToggleGroupControlOption
							value="vertical"
							label={ __( 'Vertical', 'wpba' ) }
						/>
					</ToggleGroupControl>
					<RangeControl
						label={ __( 'Starting position (%)', 'wpba' ) }
						value={ startPosition }
						min={ 0 }
						max={ 100 }
						onChange={ ( val ) => setAttributes( { startPosition: val } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ ! hasBoth ? (
					<Placeholder
						icon="image-flip-horizontal"
						label={ __( 'Before / After Slider', 'wpba' ) }
						instructions={ __(
							'Pick a Before and an After image in the sidebar.',
							'wpba'
						) }
					/>
				) : (
					<div className="wpba-editor__preview" aria-hidden="true">
						<div
							className="wpba-editor__pane wpba-editor__pane--before"
							style={ { backgroundImage: `url(${ beforeImage.url })` } }
						>
							{ beforeLabel && (
								<span className="wpba-label wpba-label--before">{ beforeLabel }</span>
							) }
						</div>
						<div
							className="wpba-editor__pane wpba-editor__pane--after"
							style={ { backgroundImage: `url(${ afterImage.url })` } }
						>
							{ afterLabel && (
								<span className="wpba-label wpba-label--after">{ afterLabel }</span>
							) }
						</div>
						<div
							className="wpba-editor__divider"
							style={
								orientation === 'horizontal'
									? { left: `${ startPosition }%` }
									: { top: `${ startPosition }%` }
							}
						/>
					</div>
				) }
			</div>
		</>
	);
}
