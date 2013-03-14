class TweetsandwichesController < ApplicationController
  # GET /tweetsandwiches
  # GET /tweetsandwiches.json
  def index
    @tweetsandwiches = Tweetsandwich.limit(42).order('id desc')

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @tweetsandwiches }
    end
  end

  # GET /tweetsandwiches/1
  # GET /tweetsandwiches/1.json
  def show
    @tweetsandwich = Tweetsandwich.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @tweetsandwich }
    end
  end

  # GET /tweetsandwiches/new
  # GET /tweetsandwiches/new.json
  def new
    @tweetsandwich = Tweetsandwich.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @tweetsandwich }
    end
  end

  # GET /tweetsandwiches/1/edit
  def edit
    @tweetsandwich = Tweetsandwich.find(params[:id])
  end

  # POST /tweetsandwiches
  # POST /tweetsandwiches.json
  def create
    @tweetsandwich = Tweetsandwich.new(params[:tweetsandwich])

    respond_to do |format|
      if @tweetsandwich.save
        format.html { redirect_to @tweetsandwich, notice: 'Tweetsandwich was successfully created.' }
        format.json { render json: @tweetsandwich, status: :created, location: @tweetsandwich }
      else
        format.html { render action: "new" }
        format.json { render json: @tweetsandwich.errors, status: :unprocessable_entity }
      end
    end
  end

  # PUT /tweetsandwiches/1
  # PUT /tweetsandwiches/1.json
  def update
    @tweetsandwich = Tweetsandwich.find(params[:id])

    respond_to do |format|
      if @tweetsandwich.update_attributes(params[:tweetsandwich])
        format.html { redirect_to @tweetsandwich, notice: 'Tweetsandwich was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @tweetsandwich.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /tweetsandwiches/1
  # DELETE /tweetsandwiches/1.json
  def destroy
    @tweetsandwich = Tweetsandwich.find(params[:id])
    @tweetsandwich.destroy

    respond_to do |format|
      format.html { redirect_to tweetsandwiches_url }
      format.json { head :no_content }
    end
  end
end
