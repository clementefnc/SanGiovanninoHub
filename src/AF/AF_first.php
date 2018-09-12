<!DOCTYPE html>
<html>
<head>
	<title>AF</title>


	<script src="https://aframe.io/releases/0.5.0/aframe.min.js"></script>
	<script src="https://unpkg.com/aframe-teleport-controls@0.2.x/dist/aframe-teleport-controls.min.js"></script>
	<script src="https://unpkg.com/aframe-controller-cursor-component@0.2.x/dist/aframe-controller-cursor-component.min.js"></script>
	<script src="https://rawgit.com/ngokevin/kframe/csstricks/scenes/aincraft/components/random-color.js"></script>
	<script src="https://rawgit.com/ngokevin/kframe/csstricks/scenes/aincraft/components/snap.js"></script>
	<script src="https://rawgit.com/ngokevin/kframe/csstricks/scenes/aincraft/components/intersection-spawn.js"></script>


	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

 	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
</head>
<body>


	<a-scene>
		
		<a-assets>
		      <img id="groundTexture" src="https://cdn.aframe.io/a-painter/images/floor.jpg">
		      <img id="skyTexture" src="https://cdn.aframe.io/a-painter/images/sky.jpg">
		      <a-mixin id="voxel"
		         geometry="primitive: box; height: 0.5; width: 0.5; depth: 0.5"
		         material="shader: standard"
		         random-color
		         snap="offset: 0.25 0.25 0.25; snap: 0.5 0.5 0.5"
		      ></a-mixin>
		    </a-assets>

		    <a-cylinder id="ground" src="#groundTexture" radius="30" height="0.1"></a-cylinder>

		    <a-sky id="background" src="#skyTexture" theta-length="90" radius="30"></a-sky>

		    <!-- Hands. -->
		    <a-entity id="teleHand" hand-controls="left" teleport-controls="type: parabolic; collisionEntities: [mixin='voxel'], #ground"></a-entity>
		    <a-entity id="blockHand" hand-controls="right" controller-cursor intersection-spawn="event: click; mixin: voxel"></a-entity>

		    <!-- Camera. -->
		    <a-camera>
		      <a-cursor intersection-spawn="event: click; mixin: voxel"></a-cursor>
		    </a-camera>
		</a-scene>
</body>
</html>