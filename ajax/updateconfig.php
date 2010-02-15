<?php

/*
 * Crows - Crowd Syndication 2.0
 * Copyright 2009
 * contact@crowsne.st
 */

/*
 * This file is part of Crows.
 *
 * Crows is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Crows is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Crows.  If not, see <http://www.gnu.org/licenses/>.
 *  */


if(array_key_exists($_POST['success']) && $_POST['success']) {
echo '{ "success":"true" }';
} else {
echo '{ "success":"false", "message":"Something went terribly wrong" }';
}
