<template>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger btn-sm" @click="closeModal()"><i class="fa fa-close"></i> Close</button>
		<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file"></i> Submit</button>
	</div>
</template>

<script >
	export default{
		name : "ModalFooter"
	}
</script>