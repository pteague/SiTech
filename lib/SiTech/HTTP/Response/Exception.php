<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace SiTech\HTTP\Response;

/**
 * Description of Exception
 *
 * @author Eric Gach <eric@php-oop.net>
 * @package SiTech\HTTP\Response
 * @version $Id$
 */
class Exception extends \SiTech\HTTP\Exception
{
}

/**
 * This exception is thrown when a badly formatted header is found.
 * 
 * @author Eric Gach <eric@php-oop.net>
 * @package SiTech\HTTP\Response
 * @version $Id$
 */
class InvalidHeaderException extends Exception
{
}

/**
 * This exception is thrown when an invalid HTTP version is used in a request.
 * 
 * @author Eric Gach <eric@php-oop.net>
 * @package SiTech\HTTP\Response
 * @version $Id$
 */
class InvalidVersionException extends Exception
{
}
