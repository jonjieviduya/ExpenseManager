<div class="modal fade" tabindex="-1" role="dialog" id="expenseCategoryModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 v-show="!isEditMode" class="modal-title">Add Expense Category</h4>
				<h4 v-show="isEditMode" class="modal-title">Update Expense Category</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label">Display Name</label>
					<input type="text" name="display_name" v-model="display_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label">Description</label>
					<input type="text" name="description" v-model="description" class="form-control" required>
				</div>
				<input type="hidden" name="id" v-model="id">
				{{ csrf_field() }}
			</div>
			<div class="modal-footer">
				<button v-show="isEditMode" type="button" class="btn btn-danger pull-left" @click="deleteExpenseCategory">Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button v-show="isEditMode" type="submit" class="btn btn-primary" @click="actionForExpenseCategory">Update</button>
				<button v-show="!isEditMode" type="submit" class="btn btn-primary" @click="actionForExpenseCategory">Save</button>
			</div>
		</div>
	</div>
</div>