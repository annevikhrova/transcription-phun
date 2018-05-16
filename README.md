# Transcription platform PHuN

## Description

Modular platform for manuscript transcription based on Symfony Framework. Includes a configurable transcription editor that uses TinyMCE.


### Platform use for contributors
Users can create accounts in order to transcribe manuscript pages.

PHuN 2.0 has three different levels of users: unidentified visitors to the site, identified users having accounts, and project leaders. Unidentified users have no specific privileges other than viewing pages on display and transcriptions contributed by other users. At this time, users holding an account can contribute to all projects.


* User comments and discussion:
During the transcription process users can also comment on a particular page. The comment button is found at the top-right corner of the editor and clicking on it will open a discussion list for the page.

### Project configuration and management for admin users
Project leaders can monitor their projects from an administrator menu. The current project administrator menu has the following components or views:

* Editor configuration:
Project administrators can modify an editor’s configuration here by defining ele- ment names, deciding on their placement in the editor, and adding descriptions of their functions to guide transcribers.

* Editor CSS styles:
From here project administrators can make adjustments to the CSS stylesheet they uploaded at the time of project creation and which controls the visual presentation of editor elements. To clarify, the editor allows to encode textual content as XML and the interface is handled by an associated CSS.

* Project Description:
Project leaders can edit the descriptions used to present their projects to the public.

* Institutional logos:
Project leaders can upload logos of partnered and participating institutions.

* Contributor list:
Project leaders have access to a list of users having contributed or intervened on one or more transcriptions for a specific project. They can access this list to promote other transcribers to project admin status (to help manage revision and validation procedures).

* Published Transcriptions:
This view displays all published transcriptions for a project. Project leaders can consult transcriptions from this list and devalidate or unpublish transcriptions considered incomplete.


## Installation

To install the platform and dependencies enter the following commands in your terminal: 

```
git clone https://github.com/annevikhrova/transcription-phun.git
cd transcription-phun
php composer.phar update
```

Once done, it is necessary to configure the project. Modify the file app/config/parameters.yml as per your requirements

```yml
parameters:
    database_host:     localhost
    database_name:     test_project
    database_user:     root
    database_password: password
```

Then generate the database and the database tables:

```
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
```

## Configuration

Please refer to Symfony documentation on how to set up data fixtures (in this case, digitized manuscript pages) for your project:

https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

