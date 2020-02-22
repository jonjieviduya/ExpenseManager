<div class="modal fade" tabindex="-1" role="dialog" id="expenseModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 v-show="!isEditMode" class="modal-title">Add Expense</h4>
				<h4 v-show="isEditMode" class="modal-title">Update Expense</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label">Expense Category</label>
					<select name="expense_category" class="form-control" v-model="expense_category">
						<option v-for="otherExpenseCategory in expense_categories" :value="otherExpenseCategory" v-text="otherExpenseCategory" :selected="otherExpenseCategory == expense_category"></option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Amount</label>
					<input type="text" name="name" v-model="amount" class="form-control" id="pureNumber" required>
				</div>
				<div class="form-group">
					<label class="control-label">Entry Date</label>
					<input type="text" name="entry_date" v-model="format_date2(entry_date)" class="form-control datepicker" readonly>
				</div>
				<input type="hidden" name="id" v-model="id">
				{{ csrf_field() }}
			</div>
			<div class="modal-footer">
				<button v-show="isEditMode" type="button" class="btn btn-danger pull-left" @click="deleteExpense">Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button v-show="isEditMode" type="submit" class="btn btn-primary" @click="actionForExpense">Update</button>
				<button v-show="!isEditMode" type="submit" class="btn btn-primary" @click="actionForExpense">Save</button>
			</div>
		</div>
	</div>
</div>