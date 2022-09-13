<?php

namespace Timber;

/**
 * Class FileSize
 *
 * Helper class to deal with File sizes logic
 *
 * @api
 * @since 2.0.0
 */
class FileSize
{
    /**
     * File location.
     *
     * @api
     * @var string The absolute path to the image in the filesystem
     *             (Example: `/var/www/htdocs/wp-content/uploads/2015/08/my-pic.jpg`)
     */
    public $file_loc;

    public function __construct($file_loc)
    {
        $this->file_loc = $file_loc;
    }

    /**
     * Gets filesize in a human readable format.
     *
     * This can be useful if you want to display the human readable filesize for a file. It’s
     * easier to read «16 KB» than «16555 bytes» or «1 MB» than «1048576 bytes».
     *
     * @return mixed|null The filesize string in a human readable format.
     * @since 2.0.0
     * @example
     *
     * Use filesize information in a link that downloads a file:
     *
     * ```twig
     * <a class="download" href="{{ attachment.src }}" download="{{ attachment.title }}">
     *     <span class="download-title">{{ attachment.title }}</span>
     *     <span class="download-info">(Download, {{ attachment.size }})</span>
     * </a>
     * ```
     *
     * @api
     */
    public function size()
    {
        if (!$this->file_size) {
            $formatted_size = size_format($this->size_raw());
            $this->file_size = str_replace(' ', '&nbsp;', $formatted_size);
        }

        return $this->file_size;
    }

    /**
     * Gets filesize in bytes.
     *
     * @return mixed|null The filesize string in bytes, or false if the filesize can’t be read.
     * @since 2.0.0
     * @example
     *
     * ```twig
     * <table>
     *     {% for attachment in Attachment(attachment_ids) %}
     *         <tr>
     *             <td>{{ attachment.title }}</td>
     *             <td>{{ attachment.extension }}</td>
     *             <td>{{ attachment.size_raw }} bytes</td>
     *         </tr>
     *     {% endfor %}
     * </table>
     * ```
     *
     * @api
     */
    public function size_raw()
    {
        if (!$this->file_size_raw) {
            $this->file_size_raw = filesize($this->file_loc);
        }

        return $this->file_size_raw;
    }
}
