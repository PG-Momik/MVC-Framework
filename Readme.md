# Introduction

A simple PHP MVC framework built from scratch.

# Pre-requisites

- ### XAMPP or Manual  created environment with:
    - #### PHP 8.0+
        ```
          sudo apt update
          sudo apt install lsb-release ca-certificates apt-transport-https software-properties-common -y
          sudo add-apt-repository ppa:ondrej/php
          sudo apt install php8.0 -y
          sudo apt install php8.0-cli php8.0-common php8.0-mbstring -y
        ```

    -  #### MySQL DB
        ```
          sudo apt update
          sudo apt install mysql-server
       ``` 
    -  #### Apache2
        ```` 
          sudo apt update
          sudo apt install apache2
        ````
- ### Composer
  ```
    sudo apt update
    cd ~
    curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
  ```
  ```
    HASH=`curl -sS https://composer.github.io/installer.sig`
    php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  ```
  ```
    sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
  ```
  ```
    composer
  ```

# Installation

- ### Create app using
  ```
    composer create-project momik/simplemvc example-app
  ```
- ### Navigate to ' public '
  ```
    cd example-app
    cd public  
  ```
- ### Serve app at port:8080
  ```
    php -S localhost:8080
  ```

# Getting Started

- ## DATABASE
  Edit the <code>.env </code> file to configure database.<br>
    - Set database name in <code>DB_DSN = ......dbname ='test_db'</code><br>
    - Set user in <code>DB_USER = root</code><br>
    - Set password in <code>DB_PASSWORD = password</code>
- ## Migration
  Run <code>migrations.php</code> to initialize database
    ```
    php migrations.php
    ```
  You can manipulate database and tables by adding scripts in ' <code>migrations</code> ' directory.<br>
    - There is no strict naming convention for migration scripts.<br>
    - Migration scripts need to be a class with classname = filename.<br>
    - Migration class need to have <code>up()</code> and <code>down()</code> method.<br>
    - Run <code>migrations.php</code> so that changes take effect.


# Documentation

- ## Entry point
    - The <code>public/index.php</code> is the entry point for the application.<br>
    - <code>public/index.php</code> determines how HTTP requests are handled.<br>
  ### Syntax:
  ```
  Router::METHOD('/url', callback);
  ```
  ### Example:
  Anonymous functions:<br>
  ```
  Router::GET('/test', function(){
    //some code here
    return "This is test."
  });
  ```
   ```
  Router::POST('/test', function(){
    //some code here
    return "This is test."
  });
  ```
  Controller functions:<br>
  ```
  Router::GET('/login', [LoginController::class, 'index']);
  ```

  ```
  Router::POST('/login', [LoginController::class, 'login']);
  ```
- ## Controllers

    - Write Controllers in <code>controllers</code> directory.<br>
    - <code>YourController</code> must extend <code>Controller</code>.<br>
    - Controllers must contain property: <code>public array $params[]</code><br>
    - Members/elements of this array property can be accessed as separate variable in respective view.
    - Example.
      ```
      $this->params['message'] = "This is message";  //in controller
      
      <p>
         <?php echo $message;?> // in view
      </p> 
      ```
      ```
      $this->params['user']['id'] = 5;  //in controller
      $this->params['user']['name'] = "foo";  
      $this->params['user']['email'] = "bar"; 
      
      <p>
      <?php echo $user['id'];?> // in view
      <?php echo $user['name'];?> 
      <?php echo $user['email'];?> 
      </p> 
      ```
- ## Models
    - Write Data models in <code>models</code> directory.<br>
    - <code>YourModel</code> must extend <code>Model</code>.<br>
    - <code>YourModel</code> must implement methods:
        - tableName( ). Returns ( string ) name of table .
        - primaryKey( ). Returns ( string ) primary field name .
        - fields( ). Returns (array of string ) containing name of all fields except primary field. .

- ## Views
    - Views can be rendered through controller by:
      ```
       return View::make('home', $this->params);
      ```
    - Write Views in <code>views</code> directory.<br>
    - <code>Views</code> must declare document title by:
      ```
      //inside view
      <?php
      /** @var  $this momik\simplemvc\core\View */
      $this->title = "Document title";
      ?>
      ```
- ## Layouts
    - You can have multiple layouts.<br>
    - Write layouts in <code>views/layouts</code>
    - Set layout through respective controller by:
      ```
      $this->setLayout('layoutName');
      ```
- ## Sessions
    - Sessions made easy.
    - Setting, Getting, Unsetting Session
      ```
      SESSION::set('key', 'value'); //setting session
      SESSION::get('key); //accessing set session
      SESSION::remove('key); //accessing set session
      ```
    - Setting and Getting Session Flash
      ```
      SESSION::setFlash('key', 'value'); //setting session flash 
      SESSION::getFlash('key); //getting session flash msg
      ```
- ## Form Validation
    - Access predefined validations. ( Study <code>core/Validation.php</code> for all available validations. )
    - Example:
      ```
        $formFields = array(
                            "email"=>"foo@bar.com",
                             "password"=>"fooBar#123"
                           );
  
        $errors = Validation::validate($formFields)  
        //returns array string of error messages.
  
        if ( empty($errors) ) {
           echo "All ok";      
        } else {
            foreach ( $errors as $error ) {
                echo $error."<br>"
            }
        }
       ```
- ## Form and Field Components
    - Create forms using the Form and Field Component.
    - Syntax:
      ```
      Form::open('actionUrl', 'requestMethod');
      echo Form::field('inputType', [assoc array of attribute and values], 'optionalErrorMsg');
      echo "<button type='submit'>Login</buton>";
      Form::close();
      ```
    - Example:
      ```
        Form::open('', "post");
        echo Form::field("email", ['name' => 'email', 'placeholder'=>'Email here'], $errors['email'] ?? '');
        echo Form::field("password", ['name' => 'password', 'placeholder'=>'Password here'], $errors['password'] ?? '');
        echo "<button type='submit' class='btn btn-md btn-primary my-2 col-12'>Login</buton>";
        Form::close();
      ```
- ## Basic CRUD Operation
  The <code>core/Model.php</code> contains commonly used CRUD operation.<br>
  These operations are inherited by all <code>dataModels</code> in the <code>models</code> directory.<br>
  Operations:
  <table>

    <tr>
      <th>Operation</th>
      <th>Method</th>
      <th>Params</th>
      <th>Description</th>
    </tr>

    <tr>
      <td> Create record </td>
      <td> save() </td>
      <td> - </td>
      <td> Inserts a record into table. </td>
    </tr>

    <tr>
      <td> Read Single record by ID </td>
      <td> fetch($id) </td>
      <td> $id </td>
      <td> Fetches record based on primary key. </td>
    </tr>

    <tr>
      <td> Read Single record by XYZ </td>
      <td> findOne($where) </td>
      <td> $where </td>
      <td> $where is a assoc array. Fetches record where multiple <code>WHERE</code> conditions are satisfied. </td>
    </tr>

    <tr>
      <td> Update record </td>
      <td> update($id) </td>
      <td> $id </td>
      <td> Updates single record based on id. </td>
    </tr>

    <tr>
      <td> Delete record </td>
      <td> delete($id) </td>
      <td> $id </td>
      <td> Deletes single record based on id. </td>
    </tr>

  </table>

# FAQs

### 1. What does <code>$request->getMethod()</code> do?

Returns <code>HTTP Request</code> method. Returns get, post, put, etc.

### 2. What does <code>$request->getBody()</code> do?

Returns assoc array of <code>HTTP Request</code> content. Mostly used to get <code>POST</code> data from form.

### 3. What does <code>$object->findOne($assocArray)</code> do?

Returns associative array from respective table where, fields and values match key and value of $assocArray.

### 4. What does <code>$object->initializeProperty($assocArray)</code> do?

Returns void. Keys of the associative array are initialized as properties of object, values of associative array are set
as respective property value.

