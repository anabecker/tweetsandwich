namespace :tweet do 
	task :update => :environment do
		Tweetsandwich.search_twitter
	end	
end