# voty

A web-based voting application utilizing PHP, JavaScript, and blockchain technology to provide secure and transparent elections.

[![Stars](https://img.shields.io/github/stars/zein114/voty?style=social)](https://github.com/zein114/voty)
[![Forks](https://img.shields.io/github/forks/zein114/voty?style=social)](https://github.com/zein114/voty)

## Table of Contents
- [Description](#description)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [API Reference](#api-reference)
- [Contributing](#contributing)
- [License](#license)
- [Important Links](#important-links)
- [Footer](#footer)

## Description

Voty is a web application designed to facilitate secure and transparent online voting. It is primarily built using PHP for the backend, JavaScript for the frontend, and integrates with blockchain technology (Hedera Hashgraph) for enhanced security and verifiability of votes. The application supports user authentication, election management (for admins), candidate management, and result publishing. It also includes multi-language support.

## Features

-   :lock:  **Secure Voting:** Leverages Hedera Hashgraph to ensure vote immutability and transparency.
-   :busts_in_silhouette: **User Authentication:** Secure sign-up and sign-in functionality with password hashing.
-   :ballot_box:  **Election Management:** Tools for administrators to create, manage, and stop elections.
-   :person: **Candidate Management:** Functionality to add, edit, and remove candidates.
-   :bar_chart: **Results Publishing:** Option to publish and unpublish election results.
-   :globe_with_meridians: **Multi-Language Support:** Supports English, French, and Arabic.
-   :mobile_phone: **Responsive Design:** User interface adapts to different screen sizes.
-   :card_index: **Voter List Upload**: Ability to upload list voters through Excel files.

## Tech Stack

-   :php: **Backend:** PHP
-   :javascript: **Frontend:** JavaScript
-   :card_file_box: **Config:** JSON, PHP
-   :art: **Styling:** CSS
-   :file_folder: **Templating:** Markdown
-   :anchor: **Other:** HTML, .htaccess

**Frameworks and Libraries:**

-   TypeScript, Express, Node.js, Python, Next.js
-   @hashgraph/sdk, axios, dotenv, express, vlucas/phpdotenv

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/zein114/voty.git
    cd voty
    ```

2.  **Set up the database:**
    -   Create a MySQL database named `voty`.
    -   Import the `voty.sql` file into your MySQL database.
    -   Update the database configuration in `core/config.php` with your database credentials:
		```php
		$host = 'localhost';
		$dbname = 'voty';
		$username = 'root';
		$password = '';
		```

3.  **Configure the Hedera API:**
    -   Navigate to `apis/hedera-api/` directory:
        ```bash
        cd apis/hedera-api/
        ```
    -   Install the dependencies using npm:
        ```bash
        npm install
        ```
    -   Create a `.env` file in the `apis/hedera-api/` directory and configure the following environment variables:
        ```
        OPERATOR_ID=<your_operator_id>
        OPERATOR_KEY_PRIVATE=<your_operator_key>
        TOPIC_ID=<your_topic_id>
        ```
    -   Run the Node.js API server:
        ```bash
        node app.js
        ```

4.  **Configure the PHP application:**
    -   Navigate to `apis/` directory:
        ```bash
        cd apis/
        ```
    -   Install the PHP dependencies using composer:
        ```bash
        composer install
        ```
    -   Create a `.env` file in the `apis/` directory and configure the following environment variables:
		```
		# Add keys here
		```

## Usage

1.  **Access the application:**
    -   Open your web browser and navigate to the project directory.

2.  **User Authentication:**
    -   Access the `auth.php` page to sign in or sign up.
    -   Use the provided credentials to log in.

3.  **Voting:**
    -   After logging in, users are redirected to the `index.php` page, where they can select an active election.
    -   Select position and candidate and submit your vote.

4.  **Admin Panel:**
    -   Super admins can access the super admin dashboard at `super_admin/dashboard.php`.
    -   Regular admins can access the admin dashboard at `admin/dashboard.php`.
    -   Admins can manage elections, candidates, and view results.

## Project Structure

```
voty/
├── apis/
│   ├── hedera-api/
│   │   ├── app.js                  # Main Node.js application for Hedera API
│   │   ├── package.json            # Node.js dependencies
│   │   └── .env                    # Environment variables for Hedera API
│   ├── api-auth.php              # Authentication API endpoints
│   ├── api.php                   # Main API endpoints for election and candidate management
│   ├── auth-helpers.php          # Authorization helper functions
│   ├── candidate-handler.php     # Candidate management API
│   ├── composer.json             # PHP dependencies
│   ├── crypto.php                # Crypto util functions
│   ├── excel-encrytion.php       # PHP excel parser to user data parser
│   ├── hedera-bridge.php         # PHP file that works as bridge between php and node to use hedera blockchain
│   └── vendor/                   # Dependencies directory
├── assets/
│   ├── css/
│   │   ├── ...                   # CSS stylesheets
│   ├── js/
│   │   ├── ...                   # JavaScript files
│   └── images/                 # Images and assets
├── core/
│   ├── config.php                # Database configuration
│   ├── lang.php                  # Language management
│   ├── logout.php                # Logout script
│   └── session.php               # Session management
├── includes/
│   ├── admin-footer.php          # Admin footer
│   ├── admin-header.php          # Admin header
│   ├── footer.php              # Main footer
│   └── header.php              # Main header
├── lang/
│   ├── ar.php                    # Arabic translations
│   ├── en.php                    # English translations
│   └── fr.php                    # French translations
├── .htaccess                   # Apache configuration file
├── about.php                   # About page
├── auth.php                    # Authentication page
├── candidates.php              # Candidates page
├── contact.php                 # Contact page
├── index.php                   # Main voting page
├── results.php                 # Results page
├── super_admin/
│   ├── admin-candidates.php   # Super Admin Candidates page
│   ├── admin-elections.php    # Super Admin Elections page
│   ├── admin-results.php      # Super Admin Election results page
│   ├── admin-settings.php     # Super Admin Settings page
│   └── dashboard.php          # Super Admin dashboard
└── voty.sql
```

## API Reference

The application exposes several API endpoints:

### Node.js API (apis/hedera-api/app.js):

-   `POST /api/receive-vote`: Receives vote data (candidateId, voterId, positionId) and submits it to the Hedera Hashgraph.
-   `POST /api/get-votes`: Fetches all votes from the Hedera Hashgraph.

### PHP API (apis/api.php):

-   `GET /api.php?action=getAllPositions`: Retrieves all positions.
-   `GET /api.php?action=getPositionByElection&id_election={id_election}`: Retrieves positions for a specific election.
-   `GET /api.php?action=getCandidatesByPosition&id_position={id_position}`: Retrieves candidates for a specific position.
-   `GET /api.php?action=getActiveElections`: Retrieves active elections for a user.

## Contributing

Contributions are welcome! Please follow these steps:

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix.
3.  Make your changes and commit them with descriptive messages.
4.  Test your changes thoroughly.
5.  Submit a pull request.

## License

This project has no specified license. All rights are reserved by the author. Contact the author before using, modifying, or distributing the software.

## Important Links

-   **Repository:** [https://github.com/zein114/voty](https://github.com/zein114/voty)

## Footer

Made with ❤️ by [zein114](https://github.com/zein114).

If you find this project useful, please consider forking, liking, starring, or opening issues on the repository!  
[voty](https://github.com/zein114/voty)

---
**<p align="center">Generated by [ReadmeCodeGen](https://www.readmecodegen.com/)</p>**
