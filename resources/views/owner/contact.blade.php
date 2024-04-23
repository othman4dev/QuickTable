@extends('layouts.owner')
@section('content')
<section class="all">
	<section class="table-heading">
        <h1>Contact us</h1>
    </section>
	<section class="table-events">
	<div class="formbold-main-wrapper" style="width: 100%;">
		<div class="formbold-form-wrapper" style="min-width: 100%;">
		  <form action="/sendMessage" method="POST" style="width: 100%;">
			@csrf
			  <div class="formbold-input-flex">
				<div>
					<input
					type="text"
					name="firstname"
					id="firstname"
					placeholder="{{ session('user')->firstname }}"
					class="formbold-form-input"
					value="{{ session('user')->firstname }}"
					readonly
					/>
					<label for="firstname" class="formbold-form-label"> First name </label>
				</div>
				<div>
					<input
					type="text"
					name="lastname"
					id="lastname"
					placeholder="{{ session('user')->lastname }}"
					class="formbold-form-input"
					value="{{ session('user')->lastname }}"
					readonly
					/>
					<label for="lastname" class="formbold-form-label"> Last name </label>
				</div>
			  </div>
			
			  <div class="formbold-input-flex">
				<div style="width: 100%;">
					<input
					type="email"
					name="email"
					id="email"
					placeholder="{{ session('user')->email }}"
					class="formbold-form-input"
					value="{{ session('user')->email }}"
					style="width: 100%;"
					readonly
					/>
					<label for="email" class="formbold-form-label"> Mail </label>
				</div>
				
			  </div>
			
			  <div class="formbold-textarea">
				  <textarea
					  rows="6"
					  name="message"
					  id="message"
					  placeholder="Write your message..."
					  class="formbold-form-input"
				  ></textarea>
				  <label for="message" class="formbold-form-label"> Message </label>
			  </div>
			
			  <button class="post-btns-btn" style="margin: 5px">
				  Send Message
			  </button>
		  </form>
		</div>
	  </div>
	</section>
</section>
@endsection
	</body>
</html>
  <style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
	* {
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	}
	body {
	  font-family: "Inter", sans-serif;
	}
	.formbold-main-wrapper {
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  padding: 48px;
	}
  
	.formbold-form-wrapper {
	  margin: 0 auto;
	  max-width: 550px;
	  width: 100%;
	  background: white;
	}
  
	.formbold-input-flex {
	  display: flex;
	  gap: 20px;
	  margin-bottom: 22px;
	}
	.formbold-input-flex > div {
	  width: 50%;
	  display: flex;
	  flex-direction: column-reverse;
	}
	.formbold-textarea {
	  display: flex;
	  flex-direction: column-reverse;
	}
  
	.formbold-form-input {
	  width: 100%;
	  padding-bottom: 10px;
	  border: none;
	  border-bottom: 1px solid #DDE3EC;
	  background: #FFFFFF;
	  font-weight: 500;
	  font-size: 16px;
	  color: #07074D;
	  outline: none;
	  resize: none;
	}
	.formbold-form-input::placeholder {
	  color: #536387;
	}
	.formbold-form-input:focus {
	  border-color: #6b000e;
	}
	.formbold-form-label {
	  color: #07074D;
	  font-weight: 500;
	  font-size: 14px;
	  line-height: 24px;
	  display: block;
	  margin-bottom: 18px;
	}
	.formbold-form-input:focus + .formbold-form-label {
	  color: #6b000e;
	}
  
	.formbold-input-file {
	  margin-top: 30px;
	}
	.formbold-input-file input[type="file"] {
	  position: absolute;
	  top: 6px;
	  left: 0;
	  z-index: -1;
	}
	.formbold-input-file .formbold-input-label {
	  display: flex;
	  align-items: center;
	  gap: 10px;
	  position: relative;
	}
  
	.formbold-filename-wrapper {
	  display: flex;
	  flex-direction: column;
	  gap: 6px;
	  margin-bottom: 22px;
	}
	.formbold-filename {
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
	  font-size: 14px;
	  line-height: 24px;
	  color: #536387;
	}
	.formbold-filename svg {
	  cursor: pointer;
	}
  
	.formbold-btn {
	  font-size: 16px;
	  border-radius: 5px;
	  padding: 12px 25px;
	  border: none;
	  font-weight: 500;
	  background-color: #6A64F1;
	  color: white;
	  cursor: pointer;
	  margin-top: 25px;
	}
	.formbold-btn:hover {
	  box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
	}
  
  </style>