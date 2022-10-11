@extends('user.threejs.master')

<!-- head -->
@push('head')
	<!-- Styles -->
	<title>Shoes</title>
	<!-- Scripts -->
@endpush

<!-- body -->
@section('content')
	<div id="info">
		<a href="https://threejs.org" target="_blank" rel="noopener">three.js</a> - GLTFLoader + <a href="https://github.com/KhronosGroup/glTF/tree/master/extensions/2.0/Khronos/KHR_materials_variants" target="_blank" rel="noopener">KHR_materials_variants</a> extension<br />
		<a href="https://github.com/pushmatrix/glTF-Sample-Models/tree/master/2.0/MaterialsVariantsShoe" target="_blank" rel="noopener">Materials Variants Shoe</a> by
		<a href="https://github.com/Shopify" target="_blank" rel="noopener">Shopify, Inc</a><br />
		<a href="https://hdrihaven.com/hdri/?h=quarry_01" target="_blank" rel="noopener">Quarry</a> by <a href="https://hdrihaven.com/" target="_blank" rel="noopener">HDRI Haven</a>
	</div>

	<script type="module">
		import * as THREE from '{{ asset("build/three.module.js") }}';
		import { GUI } from '{{ asset("jsm/libs/dat.gui.module.js") }}';
		import { OrbitControls } from '{{ asset("jsm/controls/OrbitControls.js") }}';
		import { GLTFLoader } from '{{ asset("jsm/loaders/GLTFLoader.js") }}';
		import { RGBELoader } from '{{ asset("jsm/loaders/RGBELoader.js") }}';

		let camera, scene, renderer;
		let gui;

		const state = { variant: 'midnight' };

		init();
		render();

		function init() {

			const container = document.createElement( 'div' );
			document.body.appendChild( container );

			camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.25, 20 );
			camera.position.set( 2.5, 1.5, 3.0 );

			scene = new THREE.Scene();

			new RGBELoader()
				.setDataType( THREE.UnsignedByteType )
				.setPath( '{{ asset("texture/equirectangular") }}/' )
				.load( 'quarry_01_1k.hdr', function ( texture ) {

					const envMap = pmremGenerator.fromEquirectangular( texture ).texture;

					scene.background = envMap;
					scene.environment = envMap;

					texture.dispose();
					pmremGenerator.dispose();

					render();

					// model

					const loader = new GLTFLoader().setPath( '{{ asset("models/gltf/MaterialsVariantsShoe/glTF") }}/' );
					loader.load( 'MaterialsVariantsShoe.gltf', function ( gltf ) {

						gltf.scene.scale.set( 10.0, 10.0, 10.0 );

						scene.add( gltf.scene );

						// GUI
						gui = new GUI();

						// Details of the KHR_materials_variants extension used here can be found below
						// https://github.com/KhronosGroup/glTF/tree/master/extensions/2.0/Khronos/KHR_materials_variants
						const parser = gltf.parser;
						const variantsExtension = gltf.userData.gltfExtensions[ 'KHR_materials_variants' ];
						const variants = variantsExtension.variants.map( ( variant ) => variant.name );
						const variantsCtrl = gui.add( state, 'variant', variants ).name( 'Variant' );

						selectVariant( scene, parser, variantsExtension, state.variant );

						variantsCtrl.onChange( ( value ) => selectVariant( scene, parser, variantsExtension, value ) );

						render();

					} );

				} );

			renderer = new THREE.WebGLRenderer( { antialias: true } );
			renderer.setPixelRatio( window.devicePixelRatio );
			renderer.setSize( window.innerWidth, window.innerHeight );
			renderer.toneMapping = THREE.ACESFilmicToneMapping;
			renderer.toneMappingExposure = 1;
			renderer.outputEncoding = THREE.sRGBEncoding;
			container.appendChild( renderer.domElement );

			const pmremGenerator = new THREE.PMREMGenerator( renderer );
			pmremGenerator.compileEquirectangularShader();

			const controls = new OrbitControls( camera, renderer.domElement );
			controls.addEventListener( 'change', render ); // use if there is no animation loop
			controls.minDistance = 2;
			controls.maxDistance = 10;
			controls.target.set( 0, 0.5, - 0.2 );
			controls.update();

			window.addEventListener( 'resize', onWindowResize );

		}

		function selectVariant( scene, parser, extension, variantName ) {

			const variantIndex = extension.variants.findIndex( ( v ) => v.name.includes( variantName ) );

			scene.traverse( async ( object ) => {

				if ( ! object.isMesh || ! object.userData.gltfExtensions ) return;

				const meshVariantDef = object.userData.gltfExtensions[ 'KHR_materials_variants' ];

				if ( ! meshVariantDef ) return;

				if ( ! object.userData.originalMaterial ) {

					object.userData.originalMaterial = object.material;

				}

				const mapping = meshVariantDef.mappings
					.find( ( mapping ) => mapping.variants.includes( variantIndex ) );

				if ( mapping ) {

					object.material = await parser.getDependency( 'material', mapping.material );
					parser.assignFinalMaterial(object);

				} else {

					object.material = object.userData.originalMaterial;

				}

				render();

			} );

		}

		function onWindowResize() {

			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();

			renderer.setSize( window.innerWidth, window.innerHeight );

			render();

		}

		//

		function render() {

			renderer.render( scene, camera );

		}

	</script>
@endsection