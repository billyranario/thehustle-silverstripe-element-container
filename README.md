## Installation

Install the module via Composer:

```bash
composer require thehustle/silverstripe-element-container
```

This command installs its dependencies as well, including the `dnadesign/silverstripe-elemental` module and `dnadesign/silverstripe-elemental-list` module so you don't have to install them separately.

After installation, you will need to run `http://yourdomain.com/dev/build` or `http://yourdomain.com/dev/build?flush=all` to create the database tables and flush the cache.

## Running Tasks

We need to run a task to copy a modified template from DNADesign's Elemental module to our module. This is to override the default layout of the Container Block and Column Block.

```bash
http://yourdomain.com/dev/tasks/TheHustle-Tasks-PublishTemplate
```

Most importantly, don't forget to run `dev/build` or `dev/build?flush=all` after running the task.


## Overriding Layouts

To override Container Block and Column Block layouts, you can create a new template file in your app/templates directory. 

Make sure to follow the Namespace and Directory structure of the original template file.

```bash
mkdir app/templates/TheHustle/Layout/
touch ColumnBlock.ss
touch ContainerBlock.ss
```

Don't forget to run `dev/build` or `dev/build?flush=all` after creating the new template files.

```bash
http://yourdomain.com/dev/build

```

or 

```bash
http://yourdomain.com/dev/build?flush=all
```

## Adding Tailwind as for Styling

After running the tasks from the previous step, you can  run `npm install` or `yarn install` to install the required packages.

```bash
npm install
```

or 

```bash
yarn install
```

You can generate a Tailwind config file by running the following command:

```bash
npx tailwindcss init
```

This will create a `tailwind.config.js` file in your project root.

Add the following code to your styles.css file:

```css
@import "tailwindcss/base";
@import "tailwindcss/components";
@import "tailwindcss/utilities";
```

You can then run the following command to generate a CSS file:

```bash
npx tailwindcss -i ./themes/yourtheme/css/styles.css -o ./themes/yourtheme/css/styles.min.css
```

This will generate a `styles.min.css` file in your project's CSS directory.