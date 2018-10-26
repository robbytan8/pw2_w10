<form action="" method="post">
    <fieldset>
        <legend>Book Form</legend>
        <label for="idTxtIsbn">ISBN</label>
        <input id="idTxtIsbn" name="txtIsbn" type="text" autofocus="" placeholder="ISBN" required="" maxlength="13">
        <br>
        <label for="idTxtTitle">Title</label>
        <input id="idTxtTitle" name="txtTitle" type="text" placeholder="Title" required="">
        <br>
        <label for="idTxtAuthor">Author</label>
        <input id="idTxtAuthor" name="txtAuthor" type="text" placeholder="Author" required="">
        <br>
        <label for="idTxtPublisher">Publisher</label>
        <input id="idTxtPublisher" name="txtPublisher" type="text" placeholder="Publisher" required="">
        <br>
        <label for="idTxtPublishYear">Publish Year</label>
        <input id="idTxtPublishYear" name="txtYear" type="text" placeholder="Publish Year" required="">
        <br>
        <label for="idSelCategory">Category</label>
        <select id="idSelCategory" name="selCategory">
            <?php
            /* @var $category Category */
            foreach ($categories as $category) {
                echo '<option value="' . $category->getId() . '">' . $category->getName() . '</value>';
            }
            ?>
        </select>
        <br>
        <input type="submit" name="btnSubmit" value="Submit Data">
    </fieldset>
</form>

<table id="tableId" class="display">
    <thead>
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publish Year</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php
        /* @var $book Book */
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book->getIsbn() . '</td>';
            echo '<td>' . $book->getTitle() . '</td>';
            echo '<td>' . $book->getAuthor() . '</td>';
            echo '<td>' . $book->getPublish_year() . '</td>';
            echo '<td>' . $book->getCategory()->getName() . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>