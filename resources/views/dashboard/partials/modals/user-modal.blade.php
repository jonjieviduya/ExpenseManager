<div class="modal fade" tabindex="-1" role="dialog" id="userModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 v-show="!isEditMode" class="modal-title">Add User</h4>
				<h4 v-show="isEditMode" class="modal-title">Update User</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label">Name</label>
					<input type="text" name="name" v-model="name" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					<input type="text" name="email" v-model="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label">Role</label>
					<select name="role" class="form-control" v-model="role">
						<option v-for="otherRole in roles" :value="otherRole" v-text="otherRole" :selected="otherRole == role"></option>
					</select>
				</div>
				<input type="hidden" name="id" v-model="id">
				{{ csrf_field() }}
			</div>
			<div class="modal-footer">
				<button v-show="isEditMode" type="button" class="btn btn-danger pull-left" @click="deleteUser">Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button v-show="isEditMode" type="submit" class="btn btn-primary" @click="actionForUser">Update</button>
				<button v-show="!isEditMode" type="submit" class="btn btn-primary" @click="actionForUser">Save</button>
			</div>
		</div>
	</div>
</div>