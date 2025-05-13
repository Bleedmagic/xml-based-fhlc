# Web-Based Guardian and Teacher Portal with Learning Progress and Communication Tools

A web-based portal for guardians and teachers to track learning progress of students and communicate with one another.

## Tech Used

- XML/XSL/DTD/XSD
- PHP
- HTML
- CSS
- JavaScript
- Bootstrap

> [!NOTE]
> XSLT rendering and XML transformations may behave differently across browsers. Chrome and Firefox are recommended for consistent results.

## Installation

### 1. Install and configure XAMPP

[Download link for XAMPP](https://www.apachefriends.org/download.html)

- Go to XAMPP's Control Panel.
- Followed by Apache > Config > php.ini
- Ctrl+F to find `;extension=xsl` then uncomment it.

### 2. Clone this repository

- In your File Explorer, go to "C:\xampp\htdocs"
- Make a folder named _XAMPP\
- Run this in your terminal:

```bash
git clone https://github.com/Bleedmagic/xml-based-fhlc.git
cd xml-based-fhlc
```

### 3. Run on localhost

- Here, [localhost_XAMPP](http://localhost/_XAMPP/)
- Find and click the folder, and you're done.

## Contributions

Feel free to open issues or submit pull requests for improvements or suggestions. Contributions are always welcome!

<details>

<summary>Expand for more details.</summary>

### How to Contribute (Step-by-Step)

#### Setting Up Git

Install Git: <https://git-scm.com/download/win>

#### Clone the Repository

`git clone https://github.com/Bleedmagic/xml-based-fhlc.git`

`cd xml-based-fhlc`

#### If Branches Are Already Established

`git fetch`

`git checkout feat-facade`

#### If Not, Create a New Branch

Ensure you're on the latest main branch:

`git checkout main`

`git pull origin main`

Make a branch, and give it a descriptive name based on your task:

`git checkout -b feat-username-task`

Publish your branch:

`git push -u origin feat-username-task`

#### Make Your Changes

- Edit the files you need.
- Save your work often.
- Avoid editing files others are working on unless necessary.

#### Add and Commit Your Changes

`git add .`

`git commit -m "Add: your change description"`

#### Pull Latest Changes from Main (Optional but Recommended)

  Before pushing, update your branch:

`git pull origin main`

#### Push Your Branch to GitHub

`git push --set-upstream origin feat-username-task` (For first time)

`git push` or `git pull` afterwards

#### Open a Pull Request

- Go to the repository on GitHub.
- Click the "Pull Requests" tab.
- Click "New Pull Request" and compare your branch with main.
- Add a clear title and description of your changes.
- Submit the pull request.

#### Wait for Review & Merge

- Another team member (or the team lead) will review and approve.
- Once approved, it’ll be merged into main.

#### To Update Branch (If Needed)

`git checkout feat-username-task`

`git pull origin main`

---

### Additional Stuff

<details>

<summary>Here are some answers to some questions.</summary>

#### **Note**

  Your local repo is the copy of the project on your own computer.

  A remote is a shared copy that lives online (e.g. <https://github.com/yourname/project.git>) and allows you and your team to collaborate.

`git push origin main`

- "Push my local main branch to the origin remote (usually GitHub)."

`git pull origin main`

- "Fetch and merge the latest changes from the remote main branch into my local one."

#### **Test a Pull Request**

```bash
git fetch origin
git checkout feat-username-task
git pull origin feat-username-task
```

#### **Syncing main After Merging on GitHub**

  After merging on the GitHub website:

```bash
git checkout main
git pull origin main             # Sync your local main with remote
```

#### **Keeping Your Branch Updated with Remote main**

```bash
git checkout feat-dashboard
git pull origin main            # This fetches + merges
git push origin feat-dashboard  # optional, if you want to push the updated branch
```

#### **Cleaning Up Before Switching Branches**

```bash
git restore .
git clean -fd
```

> [!WARNING]
> These commands are destructive, and you will lose any uncommitted or untracked work.

#### **Deleting a Branch**

```bash
git branch -d branch-name             # Delete local branch
git push origin -d branch-name        # Delete remote branch
```

#### **Stashing Changes**

```bash
git stash                            # Save uncommitted changes
git stash pop                        # Reapply stashed changes

# Additional for Stash Management

git stash list
git stash drop
```

#### **Undo all uncommitted changes in the whole project**

`git restore .`

#### **Undo staged changes but keep edits in working directory**

`git reset`

#### **Optional Safety Net**

`git branch backup-main main`

#### **Others**

```bash
git fetch origin             # Get latest remote changes (no merge)

git status             # Check current branch and changes
```

</details>

### Guidelines

- Make small, focused commits.
- Use clear, descriptive commit messages.
- Never push directly to main.
- Communicate if you're editing shared files.
- If unsure about Git commands, ask or check the included cheat sheet.

</details>

## LICENSE

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
