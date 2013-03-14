class AddIngredientsColumn < ActiveRecord::Migration
  def change
    add_column :tweetsandwiches, :ingredient, :string
  end
end
