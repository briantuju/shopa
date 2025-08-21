# Shopa

### Installation
> We will be using Linux commands.
1. Clone the repository, and go to the root of the project.
2. Copy the `.env.example` file to `.env` and update the values as per your environment.
3. Create the database if you don't have one, or if you don't want sqlite.
4. Run the following command in the terminal, in the project root:

```bash
composer install

php artisan key:generate

npm install
```

After the installation is completed, you can run the following command to do a clean installation:

```bash
sudo chmod +x clean_install.sh

./clean_install.sh
```

- Run the following command in the terminal, in the project root, to start the development server:

```bash
npm run dev
```

- Go to [http://localhost:8000/admin]() or the link you set up in `.env` file.
- Login with the credentials you set up in `.env` file.
- You can now start exploring the project by creating your own products, categories, and other resources.
