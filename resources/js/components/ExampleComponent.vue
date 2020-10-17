<template>
    <div class="row">
    <div class="col-12  mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Permission Index</h4>
            </div>
            <div class="card-body">
                Content here <br>
                <i class="fa fa-edit">Font Awesome Icons</i>


                
			<div class="form-group">
				<label>Password</label>
				<input
					v-model="form.password"
					type="password"
					name="password"
					class="form-control"
					:class="{ 'is-invalid': form.errors.has('password') }"
				/>
				<has-error :form="form" field="password"></has-error>
			</div>
            </div>
        </div>
    </div>



</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
