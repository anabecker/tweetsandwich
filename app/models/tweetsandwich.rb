class Tweetsandwich < ActiveRecord::Base
  attr_accessible :content, :user, :user_img_url, :ingredient, :tweet_id
  validates_uniqueness_of :tweet_id

  Twitter.configure do |config|
    config.consumer_key = 'p0sYxIiAL1nGJqYso9OJgA'
    config.consumer_secret = 'exAWR5BhdnqjROHn4tGJ3fCQUc5Rg3T1TGYjADZyThY'
    config.oauth_token = '21573136-xr9zrC0MtRIWtP5Pw6W4W4Qpk2oVtAktveJwQs7qe'
    config.oauth_token_secret = 'cXtVl0jLMwdlcLbsXOYslAMIgqzLfaJVVlgR3sZjeU'
  end

  @@ingredients = ["steak", "pork", "meatball", "cornedbeef", "chicken", "beef", "tuna", "porkchop", "blt", "bacon lettuce tomato", "ham", "turkey", "PB&J", "peanut butter & jelly", "peanut butter and jelly", "peanut butter jelly", "peanut butter", "peanut butter & banana", "peanut butter and banana", "salami", "prosciutto", "pastrami", "roast beef", "veggie", "vegetable", "ice cream", "egg ", "cheese", "bacon"]

  def set_ingredient
    @@ingredients.each do |ingredient| 
      if self.content.include? ingredient
        self.ingredient.parameterize = ingredient
      end
    end
  end

  def self.search_twitter
    Twitter.search("sandwich OR sammich OR sammie", :count => 20, :result_type => "recent").results.map do |result|
      a = Tweetsandwich.new({:content => result.text, :user => result.from_user, :user_img_url => result.profile_image_url, :tweet_id => result.id})
      a.set_ingredient
      a.save if a.ingredient
    end
  end

end

#:count => 50,
#:result_type => "recent"