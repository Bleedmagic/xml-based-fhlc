# Web-Based Guardian and Student Portal with Learning Progress and Communication Tools

A web-based portal for guardians and students to track learning progress and communicate with educators.

## Tech Used

- XML/XSL/DTD/XSD
- PHP
- HTML
- CSS
- JavaScript
- Bootstrap

## Contributions

Feel free to open issues or submit pull requests for improvements or suggestions. Contributions are always welcome!

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

  `git push --set-upstream origin feat-username-task` (Necessary for first time)

  `git push` or `git pull` afterward

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

  `git checkout main`

  `git pull origin main`

  `git checkout your-feature-branch`

  `git merge main`

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

---

#### **Pushing a New Branch to Remote**

`git push -u origin your-branch-name`

---

#### **Syncing main After Merging on GitHub**

After merging on the GitHub website:

```bash
  git checkout main
  git pull origin main             # Sync your local main with remote
```

---

#### **If You Switch to a Branch But Don’t Commit**

```bash
  git restore .
  git clean -fd
```

---

#### **Deleting a Branch**

```bash
git branch -d branchname             # Delete local branch
git push origin -d branchname        # Delete remote branch
```

---

#### **Keeping main Updated While Working on Other Branches**

```bash
git checkout main
git pull origin main                 # Update local main
git checkout your-branch-name
git merge main                       # Merge updated main into your branch
git push origin your-branch-name
```

`git rebase main` (Alternative to merge)

##### **Warning**

When using rebase, especially in team environments, be careful to avoid rewriting shared history.

---

#### **Keeping Your Branch Updated with Remote main**

```bash
git checkout your-branch-name
git fetch origin
git merge origin/main                # OR: git rebase origin/main
git push origin your-branch-name
```

---

#### **Stashing Changes**

```bash
git stash                            # Save uncommitted changes
git stash pop                        # Reapply stashed changes

# Additional for Stash Management

git stash list
git stash drop
```

---

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

## LICENSE

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
