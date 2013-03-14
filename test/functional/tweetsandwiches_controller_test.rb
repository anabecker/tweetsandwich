require 'test_helper'

class TweetsandwichesControllerTest < ActionController::TestCase
  setup do
    @tweetsandwich = tweetsandwiches(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:tweetsandwiches)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create tweetsandwich" do
    assert_difference('Tweetsandwich.count') do
      post :create, tweetsandwich: { content: @tweetsandwich.content, user: @tweetsandwich.user, user_img_url: @tweetsandwich.user_img_url }
    end

    assert_redirected_to tweetsandwich_path(assigns(:tweetsandwich))
  end

  test "should show tweetsandwich" do
    get :show, id: @tweetsandwich
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @tweetsandwich
    assert_response :success
  end

  test "should update tweetsandwich" do
    put :update, id: @tweetsandwich, tweetsandwich: { content: @tweetsandwich.content, user: @tweetsandwich.user, user_img_url: @tweetsandwich.user_img_url }
    assert_redirected_to tweetsandwich_path(assigns(:tweetsandwich))
  end

  test "should destroy tweetsandwich" do
    assert_difference('Tweetsandwich.count', -1) do
      delete :destroy, id: @tweetsandwich
    end

    assert_redirected_to tweetsandwiches_path
  end
end
