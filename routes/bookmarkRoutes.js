const express = require('express');
const router = express.Router();
const bookmarkController = require('../controllers/bookmarkController');
const authMiddleware = require('../middleware/authMiddleware');

router.post('/bookmark', authMiddleware, bookmarkController.addBookmark);
router.delete('/bookmark', authMiddleware, bookmarkController.removeBookmark);
router.get('/bookmarks', authMiddleware, bookmarkController.getBookmarks);

module.exports = router;
