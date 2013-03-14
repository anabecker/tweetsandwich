class AddTweetId < ActiveRecord::Migration
  def change
    add_column :tweetsandwiches, :tweet_id, :string
  end
end
