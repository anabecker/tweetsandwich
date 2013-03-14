class CreateTweetsandwiches < ActiveRecord::Migration
  def change
    create_table :tweetsandwiches do |t|
      t.string :content
      t.string :user
      t.string :user_img_url

      t.timestamps
    end
  end
end
