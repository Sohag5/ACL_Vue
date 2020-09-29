<template>
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">{{ $store.state.modalTitle }}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</template>

<script >
	export default{
		name : "ModalHeader",

	}
</script>