const Bookmark = require('../models/Bookmark');

exports.addBookmark = async (req, res) => {
    try {
        const bookmark = new Bookmark({
            userId: req.user._id,
            eventId: req.body.eventId
        });
        await bookmark.save();
        res.status(201).json({ message: 'Event bookmarked successfully' });
    } catch (error) {
        res.status(500).json({ error: 'Failed to bookmark event' });
    }
};

exports.removeBookmark = async (req, res) => {
    try {
        await Bookmark.findOneAndDelete({ userId: req.user._id, eventId: req.body.eventId });
        res.status(200).json({ message: 'Bookmark removed successfully' });
    } catch (error) {
        res.status(500).json({ error: 'Failed to remove bookmark' });
    }
};

exports.getBookmarks = async (req, res) => {
    try {
        const bookmarks = await Bookmark.find({ userId: req.user._id }).populate('eventId');
        res.status(200).json(bookmarks);
    } catch (error) {
        res.status(500).json({ error: 'Failed to retrieve bookmarks' });
    }
};
